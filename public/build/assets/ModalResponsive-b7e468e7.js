import{o as e,d as a,b as o,t as d,k as l,c,e as i,q as n}from"./app-1e1e7699.js";const m=["id"],r={class:"modal modal-bottom sm:modal-middle"},_={class:"modal-box"},h={class:"font-bold text-lg"},b={class:"py-4"},u={class:"modal-action"},f=["for"],v={__name:"ModalResponsive",props:["id","title","close"],setup(s){return(t,k)=>(e(),a(n,{to:"body"},[o("input",{type:"checkbox",id:s.id,class:"modal-toggle"},null,8,m),o("div",r,[o("div",_,[o("h3",h,d(s.title),1),o("div",b,[l(t.$slots,"default")]),o("div",u,[l(t.$slots,"action"),s.close?(e(),c("label",{key:0,for:s.id,class:"btn"},"Close",8,f)):i("",!0)])])])]))}};export{v as _};