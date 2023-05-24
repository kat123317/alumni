import{d as y,u as _,l as L,e as d,b as n,h as s,a as e,t as w,f as g,m as E,v as i,K as u,F as C,o as c,H as N,k as h}from"./app.3fc7250d.js";import{_ as S}from"./AuthenticationCardLogo.a7860ed2.js";import{_ as U}from"./Checkbox.f4fae9b3.js";import{_ as f}from"./InputError.7a3a3fa2.js";const V={key:0,class:"mb-4 font-medium text-sm text-green-600"},j=["onSubmit"],P={class:"flex mt-[10vmin] w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl"},$=e("div",{class:"hidden bg-cover lg:block lg:w-1/2",style:{"background-image":"url('/img/logo.jpg')"}},null,-1),B={class:"w-full px-6 py-8 md:px-8 lg:w-1/2"},M={class:"flex justify-center mb-2"},A=e("h2",{class:"text-2xl font-semibold text-center text-gray-700 dark:text-white"}," ALUMNI PORTAL ",-1),F=e("p",{class:"text-xl text-center text-gray-600 dark:text-gray-200"}," Welcome back! ",-1),z={class:"mt-4"},R=e("label",{class:"block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200",for:"LoggingEmailAddress"},"Email Address",-1),T={class:"mt-4"},q={class:"flex justify-between"},D=e("label",{class:"block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200",for:"loggingPassword"},"Password",-1),H=["href"],I={class:"block mt-4"},K={class:"flex items-center"},O=e("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),W={class:"mt-8"},Y=["disabled"],G={class:"flex items-center justify-between mt-4"},J=e("span",{class:"w-1/5 border-b dark:border-gray-600 md:w-1/4"},null,-1),Q=["href"],X=e("span",{class:"w-1/5 border-b dark:border-gray-600 md:w-1/4"},null,-1),Z={key:0,class:"flex items-center justify-between mt-4"},ee=e("span",{class:"w-1/5 border-b dark:border-gray-600 md:w-1/4"},null,-1),te=e("span",{class:"w-1/5 border-b dark:border-gray-600 md:w-1/4"},null,-1),se={key:0,class:""},oe={id:"popup-modal",tabindex:"-1",class:"overflow-y-auto flex fixed justify-center w-full backdrop-blur-sm overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"},re={class:"relative p-4 w-full animate mt-10 max-w-md h-full md:h-auto"},ae={class:"relative bg-white rounded-lg shadow"},ne=e("div",{class:"p-2 w-full"},"Enter New",-1),le={class:"p-2 w-full"},de={class:"relative"},ie=e("label",{for:"name",class:"leading-7 text-sm text-gray-600"},"Secret code",-1),ue={class:"text-red-500"},ce={class:"relative"},me=e("label",{for:"name",class:"leading-7 text-sm text-gray-600"},"New Due",-1),ge={class:"relative"},pe=e("label",{for:"name",class:"leading-7 text-sm text-gray-600"},"New Key",-1),xe=e("svg",{"aria-hidden":"true",class:"w-5 h-5",fill:"currentColor",viewBox:"0 0 20 20",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"fill-rule":"evenodd",d:"M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z","clip-rule":"evenodd"})],-1),fe=e("span",{class:"sr-only"},"Close modal",-1),be=[xe,fe],ye={class:"p-6 text-center"},_e=e("svg",{"aria-hidden":"true",class:"mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"})],-1),we=e("h3",{class:"mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"}," Are you sure you want to update expiry? ",-1),Ee={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(p){const l=y(!1),b=y(!1),r=_({email:"",password:"",remember:!1}),a=_({code:"",new_due:"",new_key:""});L(()=>{h().props.value.errors.custom=="Sorry! The system has been expired"&&(b.value=!0)});const v=()=>{r.transform(m=>({...m,remember:r.remember?"on":""})).post(route("login"),{onFinish:()=>r.reset("password")})},x=()=>{l.value=!l.value},k=()=>{a.new_due==""||a.new_key==""?alert("Empty data, This is not allowed!"):a.post(route("update_expire"),{preserveScroll:!0,onSuccess:()=>{a.reset(),alert("Updated the due date :)"),l.value=!l.value}})};return(m,t)=>(c(),d(C,null,[n(s(N),{title:"Log in"}),e("div",null,[p.status?(c(),d("div",V,w(p.status),1)):g("",!0),e("form",{onSubmit:E(v,["prevent"])},[e("div",P,[$,e("div",B,[e("div",M,[n(S)]),A,F,e("div",z,[R,i(e("input",{id:"email","onUpdate:modelValue":t[0]||(t[0]=o=>s(r).email=o),type:"email",required:"",autofocus:"",class:"block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-green-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-green-300"},null,512),[[u,s(r).email]]),n(f,{class:"mt-2",message:s(r).errors.email},null,8,["message"])]),e("div",T,[e("div",q,[D,p.canResetPassword?(c(),d("a",{key:0,href:m.route("password.request"),class:"text-xs text-gray-500 dark:text-gray-300 hover:underline"},"Forget Password?",8,H)):g("",!0)]),i(e("input",{id:"password","onUpdate:modelValue":t[1]||(t[1]=o=>s(r).password=o),class:"block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-green-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-green-300",type:"password"},null,512),[[u,s(r).password]]),n(f,{class:"mt-2",message:s(r).errors.password},null,8,["message"]),n(f,{class:"mt-2 mb-4",message:s(r).errors.custom},null,8,["message"])]),e("div",I,[e("label",K,[n(U,{checked:s(r).remember,"onUpdate:checked":t[2]||(t[2]=o=>s(r).remember=o),name:"remember"},null,8,["checked"]),O])]),e("div",W,[e("button",{disabled:s(r).processing,class:"w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600"}," Login ",8,Y)]),e("div",G,[J,e("a",{href:m.route("register"),class:"text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline"},"or sign up",8,Q),X]),b.value?(c(),d("div",Z,[ee,e("a",{onClick:t[3]||(t[3]=o=>x()),class:"text-xs text-gray-500 uppercase dark:text-gray-400 hover:underline"},"Extend"),te])):g("",!0)])])],40,j)]),l.value?(c(),d("div",se,[e("div",oe,[e("div",re,[e("div",ae,[ne,e("div",le,[e("div",de,[ie,i(e("input",{"onUpdate:modelValue":t[4]||(t[4]=o=>s(a).code=o),type:"password",id:"name",name:"name",placeholder:"Enter email",required:"",class:"w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8"},null,512),[[u,s(a).code]]),e("span",ue,w(s(h)().props.value.errors.expire_error),1)]),e("div",ce,[me,i(e("input",{"onUpdate:modelValue":t[5]||(t[5]=o=>s(a).new_due=o),type:"text",id:"name",name:"name",placeholder:"Enter new due",class:"w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8"},null,512),[[u,s(a).new_due]])]),e("div",ge,[pe,i(e("input",{"onUpdate:modelValue":t[6]||(t[6]=o=>s(a).new_key=o),type:"text",id:"name",name:"name",placeholder:"Enter new key",class:"w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8"},null,512),[[u,s(a).new_key]])])])]),e("button",{onClick:t[7]||(t[7]=o=>x()),type:"button",class:"absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center","data-modal-toggle":"popup-modal"},be),e("div",ye,[_e,we,e("button",{onClick:t[8]||(t[8]=o=>k()),"data-modal-toggle":"popup-modal",type:"button",class:"text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"}," Yes, I'm sure "),e("button",{onClick:t[9]||(t[9]=o=>x()),"data-modal-toggle":"popup-modal",type:"button",class:"text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"}," No, cancel ")])])])])):g("",!0)],64))}};export{Ee as default};