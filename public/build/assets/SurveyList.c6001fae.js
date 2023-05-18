import w from"./Pagination.f354069e.js";import{e as p,a as e,F as b,i as k,b as y,h as n,o as u,w as g,g as C,t as o,L as M,Q as _,k as d}from"./app.3fc7250d.js";import{h as m}from"./moment.9709ab41.js";const S={class:"px-2"},Y={class:"w-full text-sm text-left text-gray-500"},$=e("thead",{class:"text-xs text-gray-700 uppercase bg-green-500 text-white"},[e("tr",null,[e("th",{scope:"col",class:"py-3 px-6"},"Name"),e("th",{scope:"col",class:"py-3 px-6"},"Status"),e("th",{scope:"col",class:"py-3 px-6"},"Shown Only"),e("th",{scope:"col",class:"py-3 px-6"},"Created by"),e("th",{scope:"col",class:"py-3 px-6"},"Created"),e("th",{scope:"col",class:"py-3 px-6"},"Updated"),e("th",{scope:"col",class:"py-3 px-6"},"Action")])],-1),D={class:"bg-white border-b"},L={scope:"row",class:"py-4 px-6 font-bold capitalize text-gray-900 whitespace-nowrap"},N={class:"py-4 capitalize px-6"},z={class:"py-4 capitalize px-6"},A={class:"py-4 px-6"},B={class:"py-4 px-6"},E={class:"py-4 px-6"},I={class:"py-4 px-6"},P=["onClick"],V=["onClick"],j=["onClick"],F=["onClick"],U={class:"px-4 w-100 py-3 flex items-center justify-center border-gray-200 sm:px-6"},G={__name:"SurveyList",setup(q){const t=_("modals"),f=_("search"),l=_("form_add_edit"),x=a=>{t.copy.details.id=d().props.value.surveys.data[a].id,t.copy.details.content="Are you sure you want to copy "+d().props.value.surveys.data[a].name+"?",t.copy.show=!0},h=(a,c="edit")=>{let s=d().props.value.surveys.data[a];t.add_edit.details.method=c,t.add_edit.details.id=s.id,l.name=s.name,l.setup.shown_only=s.setup.shown_only,l.setup.select_all=s.setup.select_all,l.setup.foreign_ids=s.setup.foreign_ids,c=="edit"?(t.add_edit.details.title="Update Survey",t.add_edit.details.btn_submit="Submit"):(t.add_edit.details.title="Send Invites",t.add_edit.details.btn_submit="Send Invitation"),t.add_edit.show=!0},v=a=>{t.delete.details.id=d().props.value.surveys.data[a].id,t.delete.details.content="Are you sure you want to delete "+d().props.value.surveys.data[a].name+"?",t.delete.show=!0};return(a,c)=>(u(),p("div",S,[e("table",Y,[$,e("tbody",null,[(u(!0),p(b,null,k(a.$page.props.surveys.data,(s,i)=>(u(),p("tr",D,[e("th",L,[y(n(M),{href:a.route("surveys.questions.index",{survey_id:s.id})},{default:g(()=>[C(o(s.name),1)]),_:2},1032,["href"])]),e("td",N,o(s.status),1),e("td",z,o(s.setup.is_private==1?"Public":"Private"),1),e("td",A,o(s.user.name),1),e("td",B,o(n(m)(s.created_at).format("MMMM Do YYYY")),1),e("td",E,o(n(m)(s.updated_at).format("MMMM Do YYYY")),1),e("td",I,[e("a",{onClick:r=>h(i,"invite"),href:"#",class:"font-medium text-green-600 hover:underline"},"Send Invitation",8,P),e("a",{onClick:r=>x(i),href:"#",class:"font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2"},"Copy",8,V),e("a",{onClick:r=>h(i),href:"#",class:"font-medium text-blue-600 hover:underline ml-2"},"Edit",8,j),e("a",{onClick:r=>v(i),href:"#",class:"font-medium text-red-600 hover:underline ml-2"},"Delete",8,F)])]))),256))])]),e("div",U,[y(w,{links:a.$page.props.surveys.links,search:n(f)},null,8,["links","search"])])]))}};export{G as default};
