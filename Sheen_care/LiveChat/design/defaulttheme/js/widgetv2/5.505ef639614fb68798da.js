(window.webpackJsonpLHCReactAPP=window.webpackJsonpLHCReactAPP||[]).push([[5],{136:function(t,e,a){"use strict";a.r(e);var i,s=a(3),o=a.n(s),n=a(4),p=a.n(n),r=a(6),c=a.n(r),d=a(7),h=a.n(d),g=a(2),l=a.n(g),m=a(8),v=a.n(m),w=a(9),u=a.n(w),I=a(0),_=a.n(I),f=a(12),b=a(5),E=a(1),y=a(23),N=Object(f.b)((function(t){return{chatwidget:t.chatwidget}}))(i=function(t){function e(t){var a;return o()(this,e),a=c()(this,h()(e).call(this,t)),u()(l()(a),"state",{shown:!1}),a.hideInvitation=a.hideInvitation.bind(l()(a)),a.fullInvitation=a.fullInvitation.bind(l()(a)),a.setBotPayload=a.setBotPayload.bind(l()(a)),a}return v()(e,t),p()(e,[{key:"componentDidMount",value:function(){var t=this;E.a.sendMessageParent("showInvitation",[{name:this.props.chatwidget.getIn(["proactive","data","invitation_name"])}]),this.props.chatwidget.getIn(["proactive","data","play_sound"])&&E.a.emitEvent("play_sound",[{type:"new_invitation",sound_on:!0===this.props.chatwidget.getIn(["proactive","data","play_sound"]),widget_open:this.props.chatwidget.get("shown")&&"widget"==this.props.chatwidget.get("mode")||document.hasFocus()}]),this.props.chatwidget.hasIn(["proactive","data","full_widget"])&&!this.props.chatwidget.get("isMobile")||document.getElementById("id-invitation-height")&&setTimeout((function(){document.getElementById("id-invitation-height")&&(E.a.sendMessageParent("widgetHeight",[{force_width:t.props.chatwidget.hasIn(["proactive","data","message_width"])?t.props.chatwidget.getIn(["proactive","data","message_width"])+40:240,force_height:document.getElementById("id-invitation-height").offsetHeight+20,force_bottom:t.props.chatwidget.hasIn(["proactive","data","message_bottom"])?t.props.chatwidget.getIn(["proactive","data","message_bottom"]):75,force_right:t.props.chatwidget.hasIn(["proactive","data","message_right"])?t.props.chatwidget.getIn(["proactive","data","message_right"]):75}]),t.setState({shown:!0}))}),50)}},{key:"componentWillUnmount",value:function(){E.a.sendMessageParent("widgetHeight",[{reset_height:!0}])}},{key:"hideInvitation",value:function(t){this.props.dispatch(Object(b.f)()),t.preventDefault(),t.stopPropagation()}},{key:"fullInvitation",value:function(){E.a.sendMessageParentDirect("hideInvitation",[{full:!0,name:this.props.chatwidget.getIn(["proactive","data","invitation_name"])}]),this.props.dispatch({type:"FULL_INVITATION"})}},{key:"setBotPayload",value:function(t){this.props.setBotPayload(t),this.fullInvitation()}},{key:"render",value:function(){var t=this;this.props.chatwidget.hasIn(["proactive","data","full_widget"])&&!this.props.chatwidget.get("isMobile")&&this.fullInvitation();var e="";return!1===this.state.shown?e+=" invisible":e+=" fade-in",_.a.createElement("div",{id:"id-invitation-height",className:e},this.props.chatwidget.hasIn(["proactive","data","close_above_msg"])&&_.a.createElement("div",{className:"text-right"},_.a.createElement("button",{title:"Close",onClick:function(e){return t.hideInvitation(e)},id:"invitation-close-btn",className:"btn btn-sm rounded"},_.a.createElement("i",{className:"material-icons mr-0"},""))),_.a.createElement("div",{className:"p-2 pointer clearfix proactive-need-help",id:"proactive-wrapper",style:{width:this.props.chatwidget.hasIn(["proactive","data","message_width"])?this.props.chatwidget.getIn(["proactive","data","message_width"]):200},onClick:this.fullInvitation},!this.props.chatwidget.hasIn(["proactive","data","close_above_msg"])&&_.a.createElement("button",{title:"Close",onClick:function(e){return t.hideInvitation(e)},id:"invitation-close-btn",className:"float-right btn btn-sm rounded"},_.a.createElement("i",{className:"material-icons mr-0"},"")),this.props.chatwidget.hasIn(["proactive","data","photo_left_column"])&&this.props.chatwidget.getIn(["proactive","data","photo"])&&_.a.createElement("div",{className:"d-flex"},_.a.createElement("div",{className:"proactive-image"},_.a.createElement("img",{width:"30",alt:this.props.chatwidget.getIn(["proactive","data","name_support"])||this.props.chatwidget.getIn(["proactive","data","extra_profile"]),title:this.props.chatwidget.getIn(["proactive","data","name_support"])||this.props.chatwidget.getIn(["proactive","data","extra_profile"]),className:"mr-2 rounded",src:this.props.chatwidget.getIn(["proactive","data","photo"])})),_.a.createElement("div",{className:"flex-grow-1"},!this.props.chatwidget.hasIn(["proactive","data","hide_op_name"])&&_.a.createElement("div",{className:"fs14"},_.a.createElement("b",null,this.props.chatwidget.getIn(["proactive","data","name_support"])||this.props.chatwidget.getIn(["proactive","data","extra_profile"]))),_.a.createElement("div",{id:"inv-msg-wrapper"},_.a.createElement("p",{className:"fs13 mb-0 inv-msg-cnt",dangerouslySetInnerHTML:{__html:this.props.chatwidget.getIn(["proactive","data","message"])}}),this.props.chatwidget.hasIn(["proactive","data","bot_intro"])&&_.a.createElement(y.a,{setBotPayload:this.setBotPayload,content:this.props.chatwidget.getIn(["proactive","data","message_full"])})))),(!this.props.chatwidget.hasIn(["proactive","data","photo_left_column"])||!this.props.chatwidget.getIn(["proactive","data","photo"]))&&_.a.createElement("div",null,_.a.createElement("div",{className:"fs14"},this.props.chatwidget.getIn(["proactive","data","photo"])&&_.a.createElement("img",{width:"30",height:"30",alt:this.props.chatwidget.getIn(["proactive","data","name_support"])||this.props.chatwidget.getIn(["proactive","data","extra_profile"]),title:this.props.chatwidget.getIn(["proactive","data","name_support"])||this.props.chatwidget.getIn(["proactive","data","extra_profile"]),className:"mr-2 rounded",src:this.props.chatwidget.getIn(["proactive","data","photo"])}),!this.props.chatwidget.hasIn(["proactive","data","hide_op_name"])&&_.a.createElement("b",null,this.props.chatwidget.getIn(["proactive","data","name_support"])||this.props.chatwidget.getIn(["proactive","data","extra_profile"]))),_.a.createElement("div",{id:"inv-msg-wrapper"},_.a.createElement("p",{className:"fs13 mb-0 inv-msg-cnt",dangerouslySetInnerHTML:{__html:this.props.chatwidget.getIn(["proactive","data","message"])}}),this.props.chatwidget.hasIn(["proactive","data","bot_intro"])&&_.a.createElement(y.a,{setBotPayload:this.setBotPayload,content:this.props.chatwidget.getIn(["proactive","data","message_full"])})))))}}]),e}(I.Component))||i;e.default=N}}]);
//# sourceMappingURL=5.505ef639614fb68798da.js.map