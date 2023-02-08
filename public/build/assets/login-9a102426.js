import{h as g,L as _,r as i,o as u,c as m,t as x,e as b,b as s,a as n,w as d,i as h,F as w,g as p}from"./app-1e1e7699.js";import{I as V}from"./InputText-f9ac326c.js";import{B as k}from"./ButtonSubmit-13f22934.js";import{A as y}from"./AuthLayout-9fedbc65.js";import{_ as B}from"./_plugin-vue_export-helper-c27b6911.js";const v={layout:y,props:{flash:String},setup(){const r=g({email:null,password:null});return{login:r,submit:()=>{r.post(route("login.store"))}}},components:{InputText:V,Link:_,ButtonSubmit:k}},L=s("div",{class:"text-4xl drop-shadow-lg text-center font-semibold"},"Login",-1),S={key:0,class:"alert m-2 alert-error"},I={class:"flex flex-col gap-2 w-full mt-4"},N={class:"flex justify-start text-sm"};function T(r,o,l,t,C,F){const a=i("InputText"),f=i("Link"),c=i("ButtonSubmit");return u(),m(w,null,[L,l.flash?(u(),m("div",S,x(l.flash),1)):b("",!0),s("form",{class:"flex flex-col gap-2 p-4",onSubmit:o[2]||(o[2]=h((...e)=>t.submit&&t.submit(...e),["prevent"]))},[n(a,{required:"",title:"Email",inputValue:t.login.email,"onUpdate:inputValue":o[0]||(o[0]=e=>t.login.email=e),error:t.login.errors.email},null,8,["inputValue","error"]),n(a,{required:"",title:"Password",hidden:"",inputValue:t.login.password,"onUpdate:inputValue":o[1]||(o[1]=e=>t.login.password=e),error:t.login.errors.password},null,8,["inputValue","error"]),s("div",I,[s("div",N,[n(f,{href:r.route("register.index"),class:"link link-primary"},{default:d(()=>[p("Belum punya akun? Register.")]),_:1},8,["href"])]),n(c,{full:"",form:t.login,type:"success"},{default:d(()=>[p("login")]),_:1},8,["form"])])],32)],64)}const D=B(v,[["render",T]]);export{D as default};
