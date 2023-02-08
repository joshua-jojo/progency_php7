import{M as A}from"./MainLayout-437e79c3.js";import{C as U}from"./card-23fc99ff.js";import{I as j}from"./InputText-f9ac326c.js";import{o as i,c as l,b as t,t as c,j as d,p as B,n as S,e as f,h as C,r as p,d as I,w as h,a as s,R as _,F as N,m as T,g as F,i as M}from"./app-1e1e7699.js";import{_ as b}from"./_plugin-vue_export-helper-c27b6911.js";import{I as q}from"./InputFile-6c8dd067.js";import{B as z}from"./ButtonSubmit-13f22934.js";const D={props:{title:String,inputValue:String,error:String,required:Boolean,xs:Boolean,sm:Boolean,lg:Boolean},data(){return{data_input:this.inputValue,type_input:{"input-xs":this.xs,"input-lg":this.lg,"input-sm":this.sm}}},watch:{data_input(o){this.$emit("update:inputValue",o)}}},L={class:"form-control w-full"},P={class:"label"},R={class:"label-text capitalize"},E=["required"],G={key:0,class:"label"},J={class:"label-text-alt text-error"};function K(o,e,m,a,u,g){return i(),l("div",L,[t("label",P,[t("span",R,c(m.title),1)]),d(t("input",{type:"date","onUpdate:modelValue":e[0]||(e[0]=n=>u.data_input=n),class:S(["input input-bordered w-full",u.type_input]),required:m.required},null,10,E),[[B,u.data_input]]),m.error?(i(),l("label",G,[t("span",J,c(m.error),1)])):f("",!0)])}const O=b(D,[["render",K]]),W={layout:A,components:{Card:U,InputText:j,InputDate:O,InputFile:q,ButtonSubmit:z},props:{dataAgen:Object},setup(o){return{form:C({_method:"put",id:o.dataAgen.id,nama:o.dataAgen.user.nama,nik:o.dataAgen.nik,telp:o.dataAgen.telp,tempat_lahir:o.dataAgen.tempat_lahir,tanggal_lahir:o.dataAgen.tanggal_lahir,foto:o.dataAgen.foto,jenis_kelamin:o.dataAgen.jenis_kelamin,status_terverifikasi:o.dataAgen.status_terverifikasi,rating:o.dataAgen.rating})}},data(){return{grade:["non-grade","bronze","silver","gold","platinum"]}},methods:{submit(){this.form.post(route("pengaturan.agen.update",{agen:this.form.id}))}}},H={class:"flex justify-start flex-col"},Q={class:"flex"},X=t("div",{class:"label"},"Jenis kelamin :",-1),Y={class:"form-control w-max"},Z={class:"label cursor-pointer gap-2"},$=t("span",{class:"label-text order-last"},"Pria",-1),tt={class:"form-control w-max"},at={class:"label cursor-pointer gap-2"},et=t("span",{class:"label-text order-last"},"Wanita",-1),rt={key:0,class:"label label-text text-error"},ot={class:"grid grid-cols-2 gap-2"},it={key:1,class:"flex gap-2"},st=t("div",{class:"label"},"Status User :",-1),lt={class:"form-control w-max"},nt={class:"label cursor-pointer gap-2"},dt=t("span",{class:"label-text order-last"},"Aktif",-1),mt={class:"form-control w-max"},ut={class:"label cursor-pointer gap-2"},pt=t("span",{class:"label-text order-last"},"Tidak Aktif",-1),_t={key:2,class:"flex gap-2"},ft=t("div",{class:"label"},"Grade User :",-1),ct={class:"grid w-max grid-cols-2 lg:grid-cols-5"},gt={class:"label cursor-pointer gap-2"},ht={class:"label-text order-last"},bt=["value"],kt={class:"flex justify-end mt-4"};function vt(o,e,m,a,u,g){const n=p("input-text"),k=p("input-date"),v=p("input-file"),x=p("button-submit"),V=p("Card");return i(),I(V,{class:"flex flex-col gap-8",key:a.form.processing},{default:h(()=>[t("form",{onSubmit:e[10]||(e[10]=M((...r)=>g.submit&&g.submit(...r),["prevent"]))},[t("div",H,[s(n,{sm:"",title:"NIK",inputValue:a.form.nik,"onUpdate:inputValue":e[0]||(e[0]=r=>a.form.nik=r),error:a.form.errors.nik},null,8,["inputValue","error"]),s(n,{sm:"",title:"Nama",inputValue:a.form.nama,"onUpdate:inputValue":e[1]||(e[1]=r=>a.form.nama=r),error:a.form.errors.nama},null,8,["inputValue","error"]),t("div",Q,[X,t("div",Y,[t("label",Z,[$,d(t("input",{type:"radio","onUpdate:modelValue":e[2]||(e[2]=r=>a.form.jenis_kelamin=r),value:"pria",class:"radio radio-primary"},null,512),[[_,a.form.jenis_kelamin]])])]),t("div",tt,[t("label",at,[et,d(t("input",{type:"radio","onUpdate:modelValue":e[3]||(e[3]=r=>a.form.jenis_kelamin=r),value:"wanita",class:"radio radio-primary"},null,512),[[_,a.form.jenis_kelamin]])])])]),a.form.errors.jenis_kelamin?(i(),l("div",rt,c(a.form.errors.jenis_kelamin),1)):f("",!0),s(n,{sm:"",title:"Telp",inputValue:a.form.telp,"onUpdate:inputValue":e[4]||(e[4]=r=>a.form.telp=r),error:a.form.errors.telp},null,8,["inputValue","error"]),t("div",ot,[s(n,{sm:"",title:"tempat lahir",error:a.form.errors.tempat_lahir,inputValue:a.form.tempat_lahir,"onUpdate:inputValue":e[5]||(e[5]=r=>a.form.tempat_lahir=r)},null,8,["error","inputValue"]),s(k,{sm:"",title:"Tanggal Lahir",inputValue:a.form.tanggal_lahir,"onUpdate:inputValue":e[6]||(e[6]=r=>a.form.tanggal_lahir=r),error:a.form.errors.tanggal_lahir},null,8,["inputValue","error"])]),s(v,{form:a.form,dataIndex:"foto",title:"Foto Profile"},null,8,["form"]),o.$page.props.auth.user.role=="admin"||o.$page.props.auth.user.role=="super admin"?(i(),l("div",it,[st,t("div",lt,[t("label",nt,[dt,d(t("input",{type:"radio","onUpdate:modelValue":e[7]||(e[7]=r=>a.form.status_terverifikasi=r),value:"aktif",class:"radio radio-primary"},null,512),[[_,a.form.status_terverifikasi]])])]),t("div",mt,[t("label",ut,[pt,d(t("input",{type:"radio","onUpdate:modelValue":e[8]||(e[8]=r=>a.form.status_terverifikasi=r),value:"tidak aktif",class:"radio radio-primary"},null,512),[[_,a.form.status_terverifikasi]])])])])):f("",!0),o.$page.props.auth.user.role=="admin"||o.$page.props.auth.user.role=="super admin"?(i(),l("div",_t,[ft,t("div",ct,[(i(!0),l(N,null,T(u.grade,(r,y)=>(i(),l("div",{class:"form-control w-max",key:y},[t("label",gt,[t("span",ht,c(r),1),d(t("input",{type:"radio","onUpdate:modelValue":e[9]||(e[9]=w=>a.form.rating=w),value:r,class:"radio radio-primary"},null,8,bt),[[_,a.form.rating]])])]))),128))])])):f("",!0)]),t("div",kt,[s(x,{type:"success",form:a.form},{default:h(()=>[F("Simpan")]),_:1},8,["form"])])],32)]),_:1})}const Bt=b(W,[["render",vt]]);export{Bt as default};