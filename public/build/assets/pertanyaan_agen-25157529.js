import{h as p,o as n,c as o,b as a,a as r,w as e,F as c,m as f,t as b,j as h,p as w,u as s,g as l}from"./app-1e1e7699.js";import{_ as g}from"./card2-ad94d59b.js";import{B as x}from"./ButtonSubmit-13f22934.js";import{M as j}from"./ModalMd-8f28dfb7.js";import"./_plugin-vue_export-helper-c27b6911.js";const y={class:"flex justify-center items-center h-screen"},k={class:"w-11/12 lg:w-max"},v={class:"grid lg:grid-cols-2 gap-2"},B={class:"flex flex-col"},V={class:""},M=["onUpdate:modelValue"],S=a("label",{for:"konfirmasi",class:"btn btn-success"},"submit",-1),K={__name:"pertanyaan_agen",props:["pertanyaan"],setup(d){const t=p({data_jawaban:d.pertanyaan});function m(){t.post(route("pertanyaan.agen.store"))}return(N,T)=>(n(),o(c,null,[a("div",y,[a("div",k,[r(g,{title:"Jawablah pertanyaan berikut ini"},{action:e(()=>[S]),default:e(()=>[a("div",v,[(n(!0),o(c,null,f(s(t).data_jawaban,(_,i)=>(n(),o("div",B,[a("div",V,b(_.pertanyaan),1),h(a("textarea",{class:"textarea textarea-bordered","onUpdate:modelValue":u=>s(t).data_jawaban[i].jawaban=u},null,8,M),[[w,s(t).data_jawaban[i].jawaban]])]))),256))])]),_:1})])]),r(j,{id:"konfirmasi",title:"Konfirmasi Jawaban",close:""},{action:e(()=>[r(x,{form:s(t),onClick:m,type:"success"},{default:e(()=>[l("Submit")]),_:1},8,["form"])]),default:e(()=>[l(" Tekan Submit jika anda sudah yakin dengan jawaban anda. ")]),_:1})],64))}};export{K as default};