import{d as C,c as s,w as B,o as a,a as t,t as l,h as x,k as u,v as L,J as M,e as _,i as g,f as r,F as y,g as S,P as i}from"./app.3fc7250d.js";import{_ as D}from"./AppLayout.6ac057e3.js";import"./moment.9709ab41.js";const V={class:"bg-white"},z={class:"container px-6 py-10 mx-auto"},F={class:"flex justify-between"},N=t("h1",{class:"text-3xl font-semibold text-gray-800 capitalize lg:text-4xl"}," Survey Charts ",-1),P={class:"mt-4 text-gray-500 xl:mt-6"},T=t("option",{value:"pie"},"Pie Chart",-1),j=t("option",{value:"donut"},"Donut Chart",-1),H=t("option",{value:"bar"},"Bar Chart",-1),A=t("option",{value:"column"},"Column Chart",-1),E=t("option",{value:"line"},"Line Chart",-1),J=t("option",{value:"area"},"Area Chart",-1),Q=[T,j,H,A,E,J],R={class:"grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3"},U={class:"inline-block flex text-green-500"},$={class:"inline-block flex text-green-500"},q=["innerHTML"],G={class:"text-2xl font-semibold text-gray-700 capitalize"},I={class:"mb-8 space-y-4 text-left text-gray-500"},K=t("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor",class:"w-6 h-6 flex-shrink-0 w-5 h-5 text-green-500"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"})],-1),O={class:"decoration-sky-500"},tt={__name:"SurveyDetails",setup(W){const o=C("pie"),f=(m,c)=>{let n=0;for(let d=0;d<u().props.value.charts[c].data.length;d++)n+=u().props.value.charts[c].data[d][1];return console.log(n),(m/n*100).toFixed(2)+"%"};return(m,c)=>{const n=i("pie-chart"),v=i("bar-chart"),d=i("column-chart"),w=i("line-chart"),b=i("area-chart");return a(),s(D,{title:"survey_charts"},{default:B(()=>[t("section",V,[t("div",z,[t("div",F,[t("div",null,[N,t("p",P," Survey Reports "+l(x(u)().props.value.records_count)+" person/s who answer this survey ",1)]),t("div",null,[L(t("select",{"onUpdate:modelValue":c[0]||(c[0]=e=>o.value=e),class:"mb-2 ml-5 block p-2 px-[4vmin] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-lg focus:ring-green-500 focus:border-green-500"},Q,512),[[M,o.value]])])]),t("div",R,[(a(!0),_(y,null,g(x(u)().props.value.charts,(e,p)=>(a(),_("div",{key:p,class:"p-8 space-y-3 border-2 border-green-400 rounded-xl"},[t("span",U," Question "+l(p+1),1),t("span",$,[t("span",{innerHTML:e.instruction},null,8,q)]),t("h1",G,l(e.instructions),1),o.value=="donut"?(a(),s(n,{key:0,data:e.data,donut:!0,download:!0},null,8,["data"])):r("",!0),o.value=="pie"?(a(),s(n,{key:1,data:e.data,donut:!1,download:!0},null,8,["data"])):r("",!0),o.value=="bar"?(a(),s(v,{key:2,data:e.data,download:!0},null,8,["data"])):r("",!0),o.value=="column"?(a(),s(d,{key:3,data:e.data,download:!0},null,8,["data"])):r("",!0),o.value=="line"?(a(),s(w,{key:4,data:e.data,download:!0},null,8,["data"])):r("",!0),o.value=="area"?(a(),s(b,{key:5,data:e.data,download:!0},null,8,["data"])):r("",!0),t("ul",I,[(a(!0),_(y,null,g(e.data,(h,k)=>(a(),_("li",{key:k,class:"flex items-center space-x-3"},[K,t("span",null,[S(l(h[0])+": ",1),t("span",O,l(h[1]),1),t("span",null," - "+l(f(h[1],p)),1)])]))),128))])]))),128))])])])]),_:1})}}};export{tt as default};
