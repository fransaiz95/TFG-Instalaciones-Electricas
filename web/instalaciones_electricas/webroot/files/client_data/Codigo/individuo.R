library(Matrix)
library(abind)

############################################################################
#                               Funciones                                  #
############################################################################
# suma=function(m1,m2){
#   m=abind(m1,m2,along=3)
#   return(apply(m,1:2,sum))
# }

camino=function(i,j){
  if(Group[i]!=Group[j])return(NULL)
  path=rep(-1,53)
  cola=j
  revisados=c()
  while(length(cola)>0){
    actual=cola[1]
    cola=setdiff(cola,actual)
    revisados=c(revisados,actual)
    nuevos=setdiff(which(Grafo[actual,]==1),union(revisados,cola))
    #nuevos=setdiff(ExiLin$Start[which(ExiLin$End==actual)],revisados)
    path[nuevos]=actual
    cola=c(cola,nuevos)
    if(actual==i)break
  }
  sec=c()
  actual=i
  while (actual!=j) {
    sec=c(sec,actual)
    actual=path[actual]
  }
  return(c(sec,j))
  
}


##calculo de perdidas de enviar una unidad de flujo desde i hasta j por el camino path
perdidas=function(i,j,path){
  loss=1
  pos.i=match(i,path)
  pos.j=match(j,path)
  if(pos.j>pos.i){
    for(k in pos.i:(pos.j-1)){
      loss=loss*EffLin[path[k],path[k+1]]
    }
  }
  return(loss)
}

############################################################################
#                        solución factible                                 #
############################################################################
solucion.vacia=function(){
  Cap=NewCap=Gen=replicate(15,Matrix(0,nrow=53,ncol=14,sparse=TRUE))
  NewLin=Lin=Flo=Los=replicate(15, replicate(13,Matrix(0,nrow=53,ncol=53,sparse = TRUE)),simplify = FALSE)
  
  
  FueImp=FueUt=data.frame(matrix(0,nrow=9,ncol=15),row.names = Fue)
  
  
  #objetivos
  InvCapCos=ManCapCos=OpeCapCos=GHGEmi=WatCon=WatWit=EneMarPri=replicate(15,Matrix(0,nrow=53,ncol=14,sparse=TRUE))
  FueCos=data.frame(matrix(0,nrow=9,ncol=15),row.names = Fue)
  InvLinCos=Matrix(0,nrow=53,ncol=14)
  
  Cost=0
  Emi=0
  Wat=0
  SocPro=0
  
  return(sol=list(Cap=Cap,NewCap=NewCap,Gen=Gen,FueUt=FueUt,FueImp=FueImp,Lin=Lin,NewLin=NewLin,Flo=Flo,Los=Los,InvCapCos=InvCapCos,ManCapCos=ManCapCos,OpeCapCos=OpeCapCos,FueCos=FueCos,GHGEmi=GHGEmi,WatCon=WatCon,WatWit=WatWit,EneMarPri=EneMarPri,Cost=Cost,Emi=Emi,Wat=Wat,SocPro=SocPro))
}

solucion=function(obj,x=NULL){
  
  if(is.null(x)){
    x=solucion.vacia()
  }
  for( a in names(x)){
    assign(a,x[[a]])
  }
  
  for(y in 1:15){
    #print(y)
    
    
    ##################################################################################
    #                           cambiando de año                     
    ##################################################################################
    if(y==1){
      Cap[[y]]=ExiCap
      Lin[[y]]=ExiLin
    }else{
      Cap[[y]]=Cap[[y-1]]+NewCap[[y-1]] ##Restricción 3
      Lin[[y]]=lapply(1:13,FUN= function(i){return(Lin[[y-1]][[i]]+NewLin[[y-1]][[i]])}) ##Restricción 6
    }
    #Desinstalar plantas
    temp=UniCap[which(UniCap$AñoRetiro==y),]
    if(dim(temp)[1]>0){
      for(i in 1:dim(temp)[1]){
        Cap[[y]][temp$Region[i],temp$Tecnologia[i]]= max(0,Cap[[y]][temp$Region[i],temp$Tecnologia[i]]-temp$Capacidad[i])
      }
    }
    
    # NewCap[[y]]=Gen[[y]]=Matrix(0,nrow=53,ncol=14,sparse=TRUE)
    # 
    # NewLin[[y]]=Flo[[y]]=Los[[y]]=replicate(13,Matrix(0,nrow=53,ncol=53,sparse = TRUE))
    
    #Poner a todas las plantas a tope, con esto se busca que las regiones sean autosuficientes
    Gen[[y]]=(Cap[[y]]+NewCap[[y]])*GenAva*Hour[y]
    
    #objetivos
    # InvCapCos[[y]]=ManCapCos[[y]]=OpeCapCos[[y]]=GHGEmi[[y]]=WatCon[[y]]=WatWit[[y]]=EneMarPri[[y]]=Matrix(0,nrow=53,ncol=14,sparse=TRUE)
    
    #Demanda cubierta
    DemCov=rowSums(Gen[[y]])-Dem[,y]*(1+PlaRes)
    # ylim=c(min(DemCov),max(DemCov))
    # plot(which(DemCov>0),DemCov[which(DemCov>0)],col="blue",pch=19,xlab="Regiones",ylim=ylim,xlim=c(1,53))
    # points(which(DemCov<0),DemCov[which(DemCov<0)],col="red",pch=19)
    # points(which(DemCov==0),DemCov[which(DemCov==0)],col="green",pch=19)
    # abline(h=0,col="black")
    
    #Cuanto se debe asegurar consumir por tecnologias no flexibles
    no.flex=rowSums(Gen[[y]][,which(TypPla$Flex==0)])-Dem[,y]
   
    
    
    #Capacidad de transmision
    CapLin=lapply(1:13, FUN=function(i){return( (Lin[[y]][[i]]+NewLin[[y]][[i]])*TypLin$LinCap[i]*Hour[y])})
    CapLin[["Total"]]=Reduce("+",CapLin)
    
    
    
    ##################################################################################
    #                           Hasta cubrir la demanda
    ##################################################################################    
    
    while(length(which(DemCov< -0.1))>0){

      ##################################################################################
      #           #Seleccionar nodo de mayor demanda ---> semigreedy
      ##################################################################################

      neg=which(DemCov< -0.1)
      prob=DemCov[neg]/sum(DemCov[neg])
      if(length(neg)==1){
        nodo.neg=neg
      }else{
        nodo.neg=sample(neg,1,p=prob)
      }



      ##################################################################################
      #                                  Instalar plantas
      ##################################################################################
      pos=intersect(which(DemCov>0.1),which(Group==Group[nodo.neg]))
      #no hay opciones para enviar flujo, se debe instalar una planta
      if(length(pos)==0 | all(Dist.Mat[nodo.neg,pos]>max.lineas)){
        while(length(pos)==0 | all(Dist.Mat[nodo.neg,pos]>max.lineas)){
          posibles=which(Group==Group[nodo.neg])
          prob=Dist.Mat[nodo.neg,posibles]
          prob[which(prob==Inf)]=0
          mal=which(prob>max.lineas)

          if(length(mal)>0){
            prob[-mal]=min(prob[-mal])+max.lineas-prob[-mal]+1
            prob[-mal]=prob[-mal]/sum(prob[-mal])  #Se prefiere a los nodos mas cercanos
            prob[mal]=0
          }else{
            prob=min(prob)+max.lineas-prob
            prob=prob^5/sum(prob^5)  #Se prefiere a los nodos mas cercanos
          }
          if(length(posibles)==0) next
          if(length(prob)==1){ #cuando solo hay una opcion
            donde=posibles
          }else{
            donde=sample(posibles,1,p=prob)
          }
          #revisar posibles tecnologias
          
          tec.posibles=which(Cap[[y]][donde,]+NewCap[[y]][donde,]+TypPla$Cap <= CapAva[donde,])
          if(length(tec.posibles)==0) next
          #Instalar de acuerdo a las fucnciones objetivo

          if(obj=="Cost"){
            prob=(TypPla$NewCapCos[tec.posibles]+(16-y)*(TypPla$ManCos.1[tec.posibles] +TypPla$GenCos.1[tec.posibles]*Hour[y]))*TypPla$Cap[tec.posibles]
          }else if(obj=="Emi"){
            prob=(16-y)*TypPla$GHGEmi[tec.posibles]*TypPla$Cap[tec.posibles]*Hour[y]
          }else if(obj=="Wat"){
            prob=(16-y)*(TypPla$WatCon[tec.posibles]+TypPla$WatWit[tec.posibles])*TypPla$Cap[tec.posibles]*Hour[y]
          }else if(obj=="SocPro"){
            prob=(16-y)*TypPla$GENCOPri[tec.posibles]*TypPla$Cap[tec.posibles]*Hour[y]
          }
          prob=1-prob/(max(prob)+1)
          prob=prob/sum(prob)
          
          
          if(length(tec.posibles)==0)next
          if(length(tec.posibles)==1){
            cual=tec.posibles
          }else{
            cual=sample(tec.posibles,1,p=prob)
          }

          #actualizar no.flex
          if(TypPla$Flex[cual]==0){
            no.flex[donde]=no.flex[donde]+TypPla$Cap[cual]*Hour[y]*GenAva[donde,cual]
          }
          
          
          #instalar
          #print(paste("instala Region:",donde,"Tecnologia:",cual))
          NewCap[[y]][donde,cual]=NewCap[[y]][donde,cual]+TypPla$Cap[cual]
          Gen[[y]][donde,cual]=Gen[[y]][donde,cual]+TypPla$Cap[cual]*Hour[y]*GenAva[donde,cual]
          DemCov[donde]=DemCov[donde]+TypPla$Cap[cual]*Hour[y]*GenAva[donde,cual]
          pos=intersect(which(DemCov>0),which(Group==Group[nodo.neg]))
        }

      }
      #revisar si instale tanto en el nodo.neg que se satisface solo
        if(DemCov[nodo.neg]>0) next

      ##################################################################################
      #           #Seleccionar nodo.pos más cercano a nodo.neg  ->>semigreedy
      ##################################################################################

      #Revisar cuanto debe enviar un nodo para usar las tecnologias no flexibles
      faltan=pos[which(no.flex[pos]>0)]
      if(length(faltan>0) & !all(Dist.Mat[nodo.neg,faltan]>max.lineas)){ #estos deben salir primero
        pos=faltan
      }

      prob=Dist.Mat[nodo.neg,pos]
      mal=which(prob>max.lineas)
       if(length(mal)>0){
        prob[-mal]=min(prob[-mal])+max.lineas-prob[-mal]
        prob[-mal]=prob[-mal]/sum(prob[-mal])  #Se prefiere a los nodos mas cercanos
        prob[mal]=0
        prob2=DemCov[pos] #se prefiere a los nodos con mas demnada
        prob2[-mal]=prob2[-mal]/sum(prob2[-mal])
        prob2[mal]=0
      }else{
        prob=min(prob)+max.lineas-prob
        prob=prob/sum(prob)  #Se prefiere a los nodos mas cercanos
        prob2=DemCov[pos] #se prefiere a los nodos con mas demnada
        prob2=prob2/sum(prob2)
      }

      prob3=(2/3*prob+1/3*prob2) #se suman las distribuciones
      if(length(prob3)==1 & prob3[1]==1){ #cuando solo hay una opcion
        nodo.pos=pos
      }else{
        nodo.pos=sample(pos,1,p=prob3)
      }

      ##################################################################################
      #           Buscar camino para enviar desde nodo.pos a nodo.neg
      ##################################################################################
      instalar=data.frame()
      cap.path=Inf

      capacidad=TRUE
      while(TRUE){
        path=rep(-1,53)
        cola=nodo.neg
        revisados=c()
        while(length(cola)>0){
          actual=cola[1]
          cola=setdiff(cola,actual)
          revisados=c(revisados,actual)
          if(capacidad) {
            nuevos=setdiff(which(CapLin[["Total"]][actual,]>0.1),union(revisados,cola))
          }else nuevos=setdiff(which(Grafo[actual,]==1),union(revisados,cola))
          if(length(nuevos)>1) nuevos=sample(nuevos)
          path[nuevos]=actual
          cola=c(cola,nuevos)
          if(actual==nodo.pos)break
        }
        if(path[nodo.pos]>0) {break #existe un camino!!
        }else{
          capacidad=FALSE
        }
      }

      #Hacer camino
      sec=c()
      actual=nodo.pos
      cap.path.i=nodo.pos
      cap.path.j=nodo.neg
      while (actual!=nodo.neg) {
        sec=c(sec,actual)
        cap=CapLin[["Total"]][actual,path[actual]]
        if(cap==0){
          #Se necesita instalar esta linea
          instalar=rbind(instalar,c(Start=actual,End=path[actual]))
          cap=Inf
        }
        if(cap<cap.path) {
          cap.path=cap
          cap.path.i=actual
          cap.path.j=path[actual]
        }
        actual=path[actual]

      }
      path=c(sec,nodo.neg)
      cap.path.arco=c(cap.path.i,cap.path.j)



      #Enviar flujo de nodo,pos a nodo.neg
      # como=camino.capacitado(nodo.pos,nodo.neg)
      # path=como[[1]]
      # cap.path=como[[2]]
      # cap.path.arco=como[[3]]
      # instalar=como[[4]]


      ##################################################################################
      #                               Instalar lineas
      ##################################################################################
      if(dim(instalar)[1]>0){
        #cual tipo de linea
        cuanto=min(DemCov[nodo.pos]*perdidas(nodo.pos,cap.path.arco[1],path),-DemCov[nodo.neg]/perdidas(cap.path.arco[2],nodo.neg,path))
        posibles=which(TypLin$LinCap*Hour[y]>cuanto)
        prob=TypLin$NewLinCos[posibles]
        prob=min(prob)+max(prob)-prob
        prob=prob^5/sum(prob^5)
        for(i in 1:dim(instalar)[1]){
          if(length(posibles)==0) next
          if(length(posibles)==1){
            linea=posibles
          }else{
            linea=sample(posibles,1,p=prob)
          }


          #instalar
          NewLin[[y]][[linea]][instalar[i,1],instalar[i,2]]=NewLin[[y]][[linea]][instalar[i,1],instalar[i,2]]+1
          CapLin[[linea]][instalar[i,1],instalar[i,2]]=CapLin[[linea]][instalar[i,1],instalar[i,2]]+TypLin$LinCap[linea]*Hour[y]
          CapLin[["Total"]][instalar[i,1],instalar[i,2]]=CapLin[["Total"]][instalar[i,1],instalar[i,2]]+TypLin$LinCap[linea]*Hour[y]
        }
      }


      ##################################################################################
      #                            Enviar flujo
      ##################################################################################

      #Ahora si, a enviar flujo
      #se envia un flujo de cuanto a traves del camino path
      #cuanto<=min(exceso,deficit/perdidas(path))
      fin=length(path)
      cuanto=min(DemCov[path[1]],-DemCov[path[fin]]/perdidas(path[1],path[fin],path))
      if(cuanto>0.1){
        #verificar si es posible enviar cuanto a traves de path
        exito=FALSE
        while(!exito){
          flow=cuanto
          exito=TRUE #siendo optimista...
          for(k in 1:(length(path)-1)){
            #el arco no tiene capacidad suficiente, disminuir cuanto e intentar de nuevo
            if(CapLin[["Total"]][path[k],path[k+1]]+0.1<flow){
              cuanto=CapLin[["Total"]][path[k],path[k+1]]*cuanto/flow
              exito=FALSE
              break
            }
            flow=flow*EffLin[path[k],path[k+1]]
          }
        }

        #ahora si, a enviar cuanto a traves de path
        flow=cuanto
        if(cuanto>0.1){ #tiene sentido enviar
          for(k in 1:(length(path)-1)){
            posibles=which(sapply(1:13,FUN = function(i){return(CapLin[[i]][path[k],path[k+1]])})>0)
            #enviar flujo por las lineas posibles
            flow.linea=flow
            loss=EffLin[path[k],path[k+1]]
            for(l in posibles){
              envia=min(CapLin[[l]][path[k],path[k+1]],flow.linea)
              Flo[[y]][[l]][path[k],path[k+1]]=Flo[[y]][[l]][path[k],path[k+1]]+envia
              Los[[y]][[l]][path[k],path[k+1]]=Los[[y]][[l]][path[k],path[k+1]]+envia*(1-loss)
              CapLin[[l]][path[k],path[k+1]]=CapLin[[l]][path[k],path[k+1]]-envia
              if(CapLin [[l]][path[k],path[k+1]]>-0.1 & CapLin [[l]][path[k],path[k+1]]<0.1)CapLin [[l]][path[k],path[k+1]]=0
              CapLin [["Total"]][path[k],path[k+1]]=CapLin[["Total"]][path[k],path[k+1]]-envia
              if(CapLin [["Total"]][path[k],path[k+1]]>-0.1 & CapLin [["Total"]][path[k],path[k+1]]<0.1)CapLin [["Total"]][path[k],path[k+1]]=0

              #Revisar si hay flujo de regreso
              adelante=Flo[[y]][[l]][path[k],path[k+1]]
              regresa=Flo[[y]][[l]][path[k+1],path[k]]
              quitar= if(adelante>=regresa) regresa else adelante

              if(quitar>0){
                Flo[[y]][[l]][path[k],path[k+1]]=Flo[[y]][[l]][path[k],path[k+1]]-quitar
                Flo[[y]][[l]][path[k+1],path[k]]=Flo[[y]][[l]][path[k+1],path[k]]-quitar

                Los[[y]][[l]][path[k],path[k+1]]=Los[[y]][[l]][path[k],path[k+1]]-quitar*(1-loss)
                Los[[y]][[l]][path[k+1],path[k]]=Los[[y]][[l]][path[k+1],path[k]]-quitar*(1-loss)

                CapLin[[l]][path[k],path[k+1]]=CapLin[[l]][path[k],path[k+1]]+quitar
                CapLin[[l]][path[k+1],path[k]]=CapLin[[l]][path[k+1],path[k]]+quitar

                CapLin [["Total"]][path[k],path[k+1]]=CapLin[["Total"]][path[k],path[k+1]]+quitar
                CapLin [["Total"]][path[k+1],path[k]]=CapLin[["Total"]][path[k+1],path[k]]+quitar
              }

              flow.linea=flow.linea-envia
              if(flow.linea==0)break
            }
            flow=flow*loss
          }

          #Actualiza no flex
          if( no.flex[ path[1] ]>0){
            no.flex[ path[1] ]=no.flex[ path[1] ]-cuanto
          }

          #Actualizar DemCov
          DemCov[path[1]]=DemCov[path[1]]-cuanto
          if(DemCov[path[1]]>-0.01 & DemCov[path[1]]<0.01) DemCov[path[1]]=0
          DemCov[path[fin]]=DemCov[path[fin]]+flow
          if(DemCov[path[fin]]>-0.01 & DemCov[path[fin]]<0.01) DemCov[path[fin]]=0
        }
      }


      # plot(which(DemCov>0),DemCov[which(DemCov>0)],col="blue",pch=19,xlab="Regiones",ylim=ylim,xlim=c(1,53))
      # points(which(DemCov<0),DemCov[which(DemCov<0)],col="red",pch=19)
      # points(which(DemCov==0),DemCov[which(DemCov==0)],col="green",pch=19)
      # abline(h=0,col="black")
    }


    DemCov=rowSums(Gen[[y]])  -
      rowSums(sapply(1:13, function(l){return(rowSums(Flo[[y]][[l]]))}))+
      rowSums(sapply(1:13, function(l){return(rowSums(t(Flo[[y]][[l]])))}))-
    rowSums(sapply(1:13, function(l){return(rowSums(t(Los[[y]][[l]])))})) -Dem[,y]*(1+PlaRes)


    
    # #ylim=c(min(DemCov),max(DemCov))
    # points(which(DemCov>0),DemCov[which(DemCov>0)],col="blue",pch=19,xlab="Regiones",ylim=ylim,xlim=c(1,53))
    # points(which(DemCov<0),DemCov[which(DemCov<0)],col="red",pch=19)
    # points(which(DemCov==0),DemCov[which(DemCov==0)],col="green",pch=19)
    # abline(h=0,col="black")
    #
    # DemCov=DemCov2


    ##################################################################################
    #           Reducir generación excedente
    ##################################################################################
    pos=which(DemCov>0.1)
    
    # Gen[[y]][pos,] <( Cap[[y]][pos,]+NewCap[[y]][pos,])*GenAva[pos,]*Hour[y]
    # 
    # NewCap[[y]][pos,]/t(TypPla$Cap)
    # 
    for(nodo in pos){
      revisados=c()
      while(DemCov[nodo]>0.1){
        
        
        
        
        #solo de las tecnologias flexibles!
        tec.posibles=setdiff(which(Gen[[y]][nodo,]>0.1),revisados)
        if(length(tec.posibles)==0)break
        #while
        #Agregar preferencia si me ahorro al desinstalar
        pueden.desinstalarse=floor(DemCov[nodo]/(TypPla$Cap[tec.posibles]*GenAva[nodo,tec.posibles]*Hour[y]))
        se.instalaron=NewCap[[y]][nodo,tec.posibles]/TypPla$Cap[tec.posibles]
        desinstalar=pmin(pueden.desinstalarse,se.instalaron)
        #Reducir de acuerdo al objetivo
        if(obj=="Cost"){
          prob=TypPla$GenCos.1[tec.posibles]*DemCov[nodo]
          #ahorro por desisnstalar
          prob=prob+(TypPla$NewCapCos[tec.posibles]+(16-y)*(TypPla$ManCos.1[tec.posibles] +TypPla$GenCos.1[tec.posibles]*Hour[y]))*TypPla$Cap[tec.posibles]  *desinstalar

        }
        if(obj=="Emi"){
          prob=TypPla$GHGEmi[tec.posibles]*DemCov[nodo]
          #ahorro por desisnstalar
          prob=prob+(16-y)*TypPla$GHGEmi[tec.posibles]*TypPla$Cap[tec.posibles]*Hour[y]*desinstalar
        }
        if(obj=="Wat"){
          prob=(TypPla$WatCon[tec.posibles]+TypPla$WatWit[tec.posibles])*DemCov[nodo]
          #ahorro por desisnstalar
          prob=prob+(16-y)*(TypPla$WatCon[tec.posibles]+TypPla$WatWit[tec.posibles])*TypPla$Cap[tec.posibles]*Hour[y]*desinstalar
        }
        if(obj=="SocPro"){
          prob=TypPla$GENCOPri[tec.posibles]*DemCov[nodo]
          #ahorro por desisnstalar
          prob=prob+(16-y)*TypPla$GENCOPri[tec.posibles]*TypPla$Cap[tec.posibles]*Hour[y]*desinstalar
        }
        prob=pmax(1,prob)
        prob=prob^5/sum(prob^5)
        if(length(tec.posibles)==0)next
        if(length(tec.posibles)==1){
          cual=tec.posibles
        }else{
          cual=sample(tec.posibles,1,p=prob)
        }
        
        
        cuanto=min(DemCov[nodo],Gen[[y]][nodo,cual])
        
        #Desinstalar
        if( NewCap[[y]][nodo,cual] >0){
          
          des= min(NewCap[[y]][nodo,cual], floor(cuanto/(TypPla$Cap[cual]*GenAva[nodo,cual]*Hour[y]))*TypPla$Cap[cual])
          NewCap[[y]][nodo,cual] = NewCap[[y]][nodo,cual] - des
          
          DemCov[nodo]=DemCov[nodo]-des*GenAva[nodo,cual]*Hour[y]
          Gen[[y]][nodo,cual] = Gen[[y]][nodo,cual]-des*GenAva[nodo,cual]*Hour[y]
          cuanto=cuanto-des*GenAva[nodo,cual]*Hour[y]
          
        }
        
        if(TypPla$Flex[cual]==1){
          
          Gen[[y]][nodo,cual] = Gen[[y]][nodo,cual]-cuanto
          DemCov[nodo]=DemCov[nodo]-cuanto
        }
        
        revisados=c(revisados,cual)
        
        # plot(which(DemCov>0),DemCov[which(DemCov>0)],col="blue",pch=19,xlab="Regiones",ylim=ylim,xlim=c(1,53))
        # points(which(DemCov<0),DemCov[which(DemCov<0)],col="red",pch=19)
        # points(which(DemCov==0),DemCov[which(DemCov==0)],col="green",pch=19)
        # abline(h=0,col="black")
      }
    }

    
    
    

    ##################################################################################
    #           Calculo de combustibles
    ##################################################################################
    #TypPla[,16:24]*TypPla[,25:33]

    FueUt[,y]=colSums(TypPla[,10:18]*TypPla[,19:27]* colSums(Gen[[y]]))
    FueImp[,y]=pmax(0,FueUt[,y]-TypFue$FueNat)


    ##################################################################################
    #           Calculo de funciones objetivo
    ##################################################################################
    InvCapCos[[y]]=sweep(NewCap[[y]],MARGIN=2,TypPla$NewCapCos,`*`)
    ManCapCos[[y]]=sweep(Cap[[y]],MARGIN=2,TypPla$ManCos.1,`*`)
    OpeCapCos[[y]]=sweep(Gen[[y]],MARGIN=2,TypPla$GenCos.1,`*`)
    FueCos[,y]=FueImp[,y] * TypFue$FueCos

    GHGEmi[[y]]=sweep(Gen[[y]],MARGIN=2,TypPla$GHGEmi,`*`)
    WatCon[[y]]=sweep(Gen[[y]],MARGIN=2,TypPla$WatCon,`*`)
    WatWit[[y]]=sweep(Gen[[y]],MARGIN=2,TypPla$WatWit,`*`)

    EneMarPri[[y]]=sweep(Gen[[y]],MARGIN=2,TypPla$GENCOPri,`*`)


    Cost=Cost + sum(InvCapCos[[y]] + ManCapCos[[y]] + OpeCapCos[[y]]) + sum(FueCos[,y])
    Emi=Emi + sum(GHGEmi[[y]])
    Wat=Wat+ sum(WatCon[[y]] + WatWit[[y]])
    SocPro=SocPro + sum(EneMarPri[[y]])


   }


  #return(c(Cost,Emi,Wat,SocPro))
  return(sol=list(Cap=Cap,NewCap=NewCap,Gen=Gen,FueUt=FueUt,FueImp=FueImp,Lin=Lin,NewLin=NewLin,Flo=Flo,Los=Los,InvCapCos=InvCapCos,ManCapCos=ManCapCos,OpeCapCos=OpeCapCos,FueCos=FueCos,GHGEmi=GHGEmi,WatCon=WatCon,WatWit=WatWit,EneMarPri=EneMarPri,Cost=Cost,Emi=Emi,Wat=Wat,SocPro=SocPro,obj=obj))
}


#Cruzamiento
cruza=function(p1,p2){
  
  h1=h2=solucion.vacia()
  
  for(y in 1:15){
    h1$NewCap[[y]] = pmin(p1$NewCap[[y]],p2$NewCap[[y]])
    h2$NewCap[[y]] = p1$NewCap[[y]] + p2$NewCap[[y]]
    
    for(l in 1:13){
      h1$NewLin[[y]][[l]]=pmin( p1$NewLin[[y]][[l]],p2$NewLin[[y]][[l]])
      h2$NewLin[[y]][[l]]=p1$NewLin[[y]][[l]]+p2$NewLin[[y]][[l]]
    }
    
    
  }
  h3=h1
  h4=h2
  
  h1=solucion(p1$obj,h1)
  h2=solucion(p1$obj,h2)
  h3=solucion(p2$obj,h3)
  h4=solucion(p2$obj,h4)
  
  return(list(h1,h2,h3,h4))
}

domin.by <- function(target, challenger, total) {
  if (sum(challenger < target) > 0) {
    return(FALSE) # hay empeora
  } # si no hay empeora, vemos si hay mejora
  return(sum(challenger > target) > 0)
}

rank=function(P){
  sign=-c(1,1,1,1)
  rango=sapply(1:length(P),function(i){
    d <- logical()
    for (j in 1:length(P)) {
      d <- c(d, domin.by(sign * c(P[[i]]$Cost,P[[i]]$Emi,P[[i]]$Wat,P[[i]]$SocPro), sign * c(P[[j]]$Cost,P[[j]]$Emi,P[[j]]$Wat,P[[j]]$SocPro), 4))
    }
    cuantos <- sum(d)
    return(cuantos)
  })
  return(rango)
}


objetivos=function(sol){return(c(Cost=sol$Cost,Emi=sol$Emi,Wat=sol$Wat,SocPro=sol$SocPro))}

#### Crowding distance
crowding.distance=function(I){
  l=length(I)
  distance=rep(0,l)
  obj=t(sapply(I, objetivos))
  
  for(m in 1:4){
    orden=order(obj[,m])
    distance[orden[1]]=distance[orden[l]]=Inf
    for(i in 2:(l-1)){
      distance[orden[i]]=distance[orden[i]]+obj[orden[i+1],m]-obj[orden[i-1],m]
    }
  }
  return(distance)
}


mutacion=function(p){
  
  
  quitar=sample(c(TRUE,FALSE),1)
  
  if(quitar){
    posibles=c()
    cont=1
    while(length(posibles)==0 & cont<=5){
      año=sample(1:15,1)
      posibles=which(p$NewCap[[año]]>0)
      cont=cont+1
    }
    
    if(length(posibles)==0) return(p)
    if(length(posibles)==1){
      donde=posibles
    }else{
      donde=sample(posibles,1)
    }
    
    p$NewCap[[año]][donde]=max(0,p$NewCap[[año]][donde]-TypPla$Cap[donde%%14+1])
    
  }else{
    año=sample(1:15,1)
    donde=sample(1:(53*14),1)
    p$NewCap[[año]][donde]=p$NewCap[[año]][donde]+TypPla$Cap[donde%%14+1]
  }
  p=solucion(p$obj,p)
  return(p)
}

############################################################################
#                      Lectura de parametros                               #
############################################################################
folder="../Parametros"


#Nombres de regiones
Reg=as.character(read.delim(paste(folder,"Reg.txt",sep="/"),header=FALSE)$V1)

#Grupos
Group=c(rep(1,45),rep(2,4),rep(3,3),4)

#Nombres de combustibles
Fue=as.character(read.delim(paste(folder,"Fue.txt",sep="/"),header=FALSE)$V1)

#Nombres de combustibles
Tec=as.character(read.delim(paste(folder,"Tec.txt",sep="/"),header=FALSE)$V1)

#Horas por año
Hour=as.numeric(read.delim(paste(folder,"Hours.txt",sep="/"),header=FALSE)$V1)

#Margen de reserva
ForMar = read.delim(paste(folder,"ForMar.txt",sep="/"),header=FALSE)
PlaRes=ForMar[,1]+ForMar[,2] ### Restricción 2

#Capacidad existente
ExiCap=Matrix(data.matrix(read.delim(paste(folder,"ExiCap.txt",sep="/"),header=F)),sparse=TRUE)

#Lineas existentes
ExiLin=read.delim(paste(folder,"ExiLin.txt",sep="/"),header=F)
names(ExiLin)=c("Start","End","TypLin","Dis")

temp2=replicate(13,Matrix(0,nrow=53,ncol=53,sparse = TRUE))

temp=Dis=Matrix(0,nrow=53,ncol=53,sparse = TRUE)
for(i in 1:dim(ExiLin)[1]){
  temp[ExiLin$Start[i],ExiLin$End[i]]=1
  temp[ExiLin$End[i],ExiLin$Start[i]]=1
  Dis[ExiLin$End[i],ExiLin$Start[i]]=ExiLin$Dis[i]
  Dis[ExiLin$End[i],ExiLin$Start[i]]=ExiLin$Dis[i]
  
  temp2[[ExiLin$TypLin[i]+1]][ExiLin$Start[i],ExiLin$End[i]]=1
  temp2[[ExiLin$TypLin[i]+1]][ExiLin$End[i],ExiLin$Start[i]]=1
}
Grafo=temp
ExiLin=temp2


#Calcular distancia entre Regiones
Dist.Mat=matrix(0,nrow=53,ncol=53)
for(i in 1:53){
  for(j in 1:53){
    if(i==j){
      Dist.Mat[i,i]=Inf
    }else{
      Dist.Mat[i,j]=length(camino(i,j))-1
    }
  }
}
Dist.Mat[which(Dist.Mat==-1)]=Inf

#Calcular matriz de probabilidades de instalación
# for(i in 1:53){
#   cuales=setdiff(which(Group==Group[i]),i)
#   trans=1+max(Dist.Mat[i,cuales])-Dist.Mat[i,cuales]
#   Dist.Mat[i,cuales]= trans^4/sum(trans^4)
#   Dist.Mat[i,-cuales]=0
#   if (length(cuales)==0)Dist.Mat[i,]=0
# }

#Demanda
Dem=data.frame(read.delim(paste(folder,"Dem.txt",sep="/"),header=F),row.names = Reg)

#Disponibilidad de capacidad
CapAva=data.matrix(read.delim(paste(folder,"CapAva.txt",sep="/"),header=F))
CapAva=CapAva+data.matrix(ExiCap)

#Disponibilidad d generación
GenAva=data.matrix(read.delim(paste(folder,"GenAva.txt",sep="/"),header=F))
#names(GenAva)=Tec

#Plantas a desinstalar
UniCap=read.delim(paste(folder,"UniCap.txt",sep="/"))

#Información de las plantas
TypPla=data.frame(read.delim(paste(folder,"TypPla.txt",sep="/")),row.names = Tec)

#Información de las lineas
TypLin=data.frame(read.delim(paste(folder,"TypLin.txt",sep="/")))

#Información de combustibles
TypFue=data.frame(read.delim(paste(folder,"TypFue.txt",sep="/")))

#Resistencia de conductor (Aluminio)
mu=0.004308

#Temperatura
Tem=data.frame(read.delim(paste(folder,"Tem.txt",sep="/"),header=F),row.names = Reg)
Tem=rowSums(Tem)/12
#names(Tem)=c("January","February","March","April","May","June","July","August","September","October","November","December")


#Factor de corrección por temperatura
TemFac=matrix(0,nrow=53,ncol=53)
for(i in 1:53){
  for(j in 1:53){
    TemFac[i,j]=1+mu*((Tem[i]+Tem[j])/2-20)
  }
}

#Eficiencia de las lineas
EffLin=Matrix(0,nrow = 53,ncol=53,sparse = TRUE)
EffLinBas=mean(TypLin$EffLinBas[-1])
for(i in 1:53){
  for(j in 1:53){
    if(Grafo[i,j]==1){
      EffLin[i,j]=min(1,EffLinBas*TemFac[i,j])
    }
  }
}

#maximo número de lineas para enviar flujo
max.lineas=6


x=solucion("Cost")
print(objetivos(x))

# ############################################################################
# #                        NSGA                                #
# ############################################################################
# 
# start_nsga=Sys.time()
# 
# library(parallel)
# cluster=makeCluster(detectCores() - 1)
# clusterEvalQ(cluster, library(Matrix))
# clusterExport(cluster,c("solucion","Uni","solucion.vacia", "colSums","rowSums","Matrix","CapAva","Dem","Dis","Dist.Mat","EffLin","ExiCap","ExiLin","ForMar","GenAva","Grafo","TemFac","TypFue","TypLin","TypPla","EffLinBas","Fue","Group","Hour","max.lineas","mu","PlaRes","Reg","Tec","Tem","camino","perdidas"))
# 
# ##################    Parametros    ##################
# tamp_pop=4
# prob.muta=0.05
# 
# ##################    Población inicial   ##################
# obj2=rep(c("Cost","Emi","Wat","SocPro"),1,each=ceiling(tamp_pop/4))
# tamp_pop=length(obj2)
# 
# start=Sys.time()
# #P=lapply(obj2,solucion)
# 
# P=parLapply(cluster,obj2,solucion)
# end=Sys.time()
# print(difftime(end,start,units = "secs"))
# 
# evolucion=t(sapply(P, objetivos))
# write.csv(evolucion,"evolucionInicio.csv")
# save.image("inicial.RData")
# stopCluster(cluster)
# 
# for(g in 1:20){
#   library(parallel)
#   cluster=makeCluster(detectCores() - 1)
#   clusterEvalQ(cluster, library(Matrix))
#   clusterExport(cluster,c("Uni","solucion.vacia", "colSums","rowSums","Matrix","CapAva","Dem","Dis","Dist.Mat","EffLin","ExiCap","ExiLin","ForMar","GenAva","Grafo","TemFac","TypFue","TypLin","TypPla","EffLinBas","Fue","Group","Hour","max.lineas","mu","PlaRes","Reg","Tec","Tem","camino","perdidas"))
#   
#   print(g)
#   ################ Cruzamiento ###################
#   rango=rank(P)
#   prob=(max(rango)+1-rango)/sum(max(rango)+1-rango)
#   parejas=t(sapply(1:ceiling(length(P)/4), function(i){return(sample(1:length(P),2,p=prob))}))
#   
#   clusterExport(cluster,c("solucion","cruza","P","parejas"))
#   start_hijos=Sys.time()
#   #Q=lapply(1:ceiling(length(P)/4), function(i){return(cruza(P[[parejas[i,1]]],P[[parejas[i,2]]]))})
#   Q=parLapply(cluster,1:ceiling(length(P)/4), function(i){return(cruza(P[[parejas[i,1]]],P[[parejas[i,2]]]))})
#   Q=unlist(Q,recursive = F)
#   end_hijos=Sys.time()
#   print(difftime(end_hijos,start_hijos,units = "secs"))
#   
#   ############ Mutación ############
#   # mutan=which(runif(tamp_pop)<prob.muta)
#   # if(length(mutan)>0){
#   # res=lapply(mutan,function(m){return(mutacion(Q[[m]]))})
#   # rbind(t(sapply(res, objetivos)),t(sapply(Q[mutan], objetivos)))
#   # }
#   
#   #############   Siguiente población ##########
#   R=c(P,Q)
#   rm("P")
#   rm("Q")
#   rango=rank(R)
#   P=c()
#   for(i in 0:(2*tamp_pop)){
#     if(length(P)==tamp_pop)break
#     
#     F_i=which(rango==i)
#     
#     if(length(P)+length(F_i)<=tamp_pop){
#       P=c(P,R[F_i])
#     }else{
#       distance=crowding.distance(R[F_i])
#       P=c(P, R[F_i[order(distance,decreasing = TRUE)[1: (tamp_pop-length(P))]]])
#     }
#   }
#   
#   rm("R")
#   evolucion=cbind(evolucion,t(sapply(P, objetivos)))
#   write.csv(evolucion,paste("evolucion",g,".csv",sep=""))
#   save.image(paste("evolucion",g,".RData",sep=""))
#   stopCluster(cluster)
#   
# }
# 
# end_nsga=Sys.time()
# print(difftime(end_nsga,start_nsga,units = "secs"))
# 
# #write.csv(evolucion,"evolucionFin.csv")
# 
# 
# #save.image("Resultados.RData")

