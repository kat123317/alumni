import{j as b,d as p,p as x,e as t,F as f,i as w,Q as a,o as r,n as y,a as k,c as L,w as M,h as v,L as B}from"./app.3fc7250d.js";const H={class:"mt-6 -mb-1 flex flex-wrap"},T=["innerHTML"],j=["innerHTML"],E={__name:"Pagination",props:["links","search"],setup(n){const c=n,g=b(()=>c.search!=""&&c.search!=null?"&search="+c.search:""),e=p(""),i=a("trigger"),o=a("filter_courses_id"),u=a("user_search_key"),_=a("announcement_search_key"),h=a("event_search_key"),d=a("year_search_key"),m=a("alumni_search_key");return x(()=>{i.value&&(e.value+="&trigger="+i.value),o&&(e.value+="&id="+o),u&&(e.value+="&user_search_key="+u),_&&(e.value+="&announcement_search_key="+_),h&&(e.value+="&event_search_key="+h),d&&(e.value+="&year_search_key="+d),m&&(e.value+="&alumni_search_key="+m)}),(C,F)=>(r(),t("div",H,[(r(!0),t(f,null,w(n.links,(s,l)=>(r(),t(f,{key:l},[s.url===null?(r(),t("div",{key:0,class:y(["mr-1 mb-1 px-2 py-1 text-sm bg-white border rounded text-gray-400",{"ml-auto":n.links.length===l+1}])},[k("span",{innerHTML:s.label},null,8,T)],2)):(r(),L(v(B),{key:1,class:y(["mr-1 mb-1 px-2 bg-white py-1 text-sm shadow-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500",{"bg-white":s.active,"ml-auto":n.links.length===l+1}]),href:s.url+v(g)+e.value},{default:M(()=>[k("span",{innerHTML:s.label},null,8,j)]),_:2},1032,["class","href"]))],64))),128))]))}};export{E as default};