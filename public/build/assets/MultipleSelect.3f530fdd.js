import{j as b,e as r,F as v,i as p,o as a,a as t,v as f,A as h,h as l,t as c,n as w,c as y,f as x,Q as V}from"./app.3fc7250d.js";import k from"./InputText.47d45497.js";import{h as B}from"./helpers.6ae94cef.js";const q={class:"grid grid-cols-9 gap-1 mb-5"},C={class:"sm:col-span-4 col-span-9"},N={class:"flex"},U=["onUpdate:modelValue","disabled"],j={key:0},A={class:"text-green-800 break-words w-[40vmin] ml-5 mt-n1 text-2xl"},D={class:"w-screen"},F=["src"],M={key:1,class:"ml-2 break-words w-[40vmin] text-gray-800 text-lg font-lg mr-2 px-2.5 py-0.5 rounded"},Q={__name:"MultipleSelect",props:{modelValue:[Object,Number],choices:Array,disabled:{type:Boolean,default:!1},image:Boolean,qid:Number},emits:["update:modelValue"],setup(s,{emit:m}){const u=s,{random_str:_}=B(),g=_(2),n=V("my_choices"),o=b({get(){return u.modelValue},set(i){m("update:modelValue",i)}});return(i,S)=>(a(),r("div",q,[(a(!0),r(v,null,p(s.choices,(e,z)=>(a(),r("div",C,[t("div",N,[f(t("input",{"onUpdate:modelValue":d=>l(o)["choice_"+e.value]=d,type:"checkbox",disabled:s.disabled,"true-value":1,"false-value":0,class:"rounded w-6 h-6 border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"},null,8,U),[[h,l(o)["choice_"+e.value]]]),s.image==!0&&e.img_src!=null&&e.img_src!=""?(a(),r("div",j,[t("div",null,[t("p",A,c(e.label),1)]),t("div",D,[t("img",{src:"/images/questions/"+e.img_src+"?rnd="+l(g),class:w(["w-[30vmin] bg-white-200 border-solid border-2 border-gray-500 rounded-md",s.image==!0?"mt-5 mb-10":""])},null,10,F)])])):(a(),r("span",M,c(e.label),1))]),e.write_in?(a(),y(k,{key:0,class:"ml-6",disabled:l(o)["choice_"+e.value]==0||s.disabled==!0,modelValue:l(n).answers["write_in_"+s.qid]["write_"+e.value],"onUpdate:modelValue":d=>l(n).answers["write_in_"+s.qid]["write_"+e.value]=d},null,8,["disabled","modelValue","onUpdate:modelValue"])):x("",!0)]))),256))]))}};export{Q as default};