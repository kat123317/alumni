import{_ as f}from"./AppLayout.6ac057e3.js";import c from"./ConversationList.8a6b3c53.js";import p from"./Messages.00ca434d.js";import v from"./MessageInput.f870c93f.js";import h from"./MessageHeader.ec62ea82.js";import{u as l,j as g,p as x,z as b,q as w,c as $,w as j,Q as k,o as y,a as o,b as i,W as r}from"./app.3fc7250d.js";import"./moment.9709ab41.js";import"./style.3c83f18d.js";const B={class:"container mx-auto"},E={class:"py-6 px-2"},M={class:"flex border border-grey h-[150vmin] lg:h-[80vmin] rounded shadow-lg"},I={class:"w-full border flex flex-col"},Q={__name:"MessengerPage",props:["conversations","user_selected","messages","conversation_id","users"],setup(d){const s=d,a=l({conversation_id:s.conversation_id,selected_user_id:null}),_=l({conversation_id:s.conversation_id,content:""}),n=k("online_users"),m=g(()=>s.user_selected!=""?n.value.find(t=>t.id==s.user_selected.id)!=null:!1);return x(()=>{a.conversation_id!=null&&Echo.channel("message."+a.conversation_id).listen(".message-sent",e=>{b.Inertia.reload({only:["messages","conversations"]})}),Echo.join("online-users").here(e=>{n.value=e}).joining(e=>{n.value.push({id:e.id,name:e.name,profile_photo_url:e.profile_photo_url})}).leaving(e=>{let t=n.value.findIndex(u=>u.id==e.id);n.value.splice(t,1)})}),w(()=>{s.conversation!=null&&Echo.channel("message."+s.conversation.id).stopListening(".message-sent")}),r("open_convo_data",a),r("message_data",_),r("selected_is_online",m),(e,t)=>(y(),$(f,{title:"Messenger"},{default:j(()=>[o("div",null,[o("div",B,[i(c,{class:"block mt-5 w-screen min-h-[90vmin] lg:hidden"}),o("div",E,[o("div",M,[i(c,{class:"hidden lg:block"}),o("div",I,[i(h),i(p),i(v)])])])])])]),_:1}))}};export{Q as default};
