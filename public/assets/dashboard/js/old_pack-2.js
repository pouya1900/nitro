/*!
 * Theia Sticky Sidebar v1.2.2
 * https://github.com/WeCodePixels/theia-sticky-sidebar
 */
(function($){$.fn.theiaStickySidebar=function(options){var defaults={'containerSelector':'','additionalMarginTop':0,'additionalMarginBottom':0,'updateSidebarHeight':true,'minWidth':0};options=$.extend(defaults,options);options.additionalMarginTop=parseInt(options.additionalMarginTop)||0;options.additionalMarginBottom=parseInt(options.additionalMarginBottom)||0;$('head').append($('<style>.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>'));this.each(function(){var o={};o.sidebar=$(this);o.options=options||{};o.container=$(o.options.containerSelector);if(o.container.size()==0){o.container=o.sidebar.parent();}
o.sidebar.parents().css('-webkit-transform','none');o.sidebar.css({'position':'relative','overflow':'visible','-webkit-box-sizing':'border-box','-moz-box-sizing':'border-box','box-sizing':'border-box'});o.stickySidebar=o.sidebar.find('.theiaStickySidebar');if(o.stickySidebar.length==0){o.sidebar.find('script').remove();o.stickySidebar=$('<div>').addClass('theiaStickySidebar').append(o.sidebar.children());o.sidebar.append(o.stickySidebar);}
o.marginTop=parseInt(o.sidebar.css('margin-top'));o.marginBottom=parseInt(o.sidebar.css('margin-bottom'));o.paddingTop=parseInt(o.sidebar.css('padding-top'));o.paddingBottom=parseInt(o.sidebar.css('padding-bottom'));var collapsedTopHeight=o.stickySidebar.offset().top;var collapsedBottomHeight=o.stickySidebar.outerHeight();o.stickySidebar.css('padding-top',1);o.stickySidebar.css('padding-bottom',1);collapsedTopHeight-=o.stickySidebar.offset().top;collapsedBottomHeight=o.stickySidebar.outerHeight()-collapsedBottomHeight-collapsedTopHeight;if(collapsedTopHeight==0){o.stickySidebar.css('padding-top',0);o.stickySidebarPaddingTop=0;}
else{o.stickySidebarPaddingTop=1;}
if(collapsedBottomHeight==0){o.stickySidebar.css('padding-bottom',0);o.stickySidebarPaddingBottom=0;}
else{o.stickySidebarPaddingBottom=1;}
o.previousScrollTop=null;o.fixedScrollTop=0;resetSidebar();o.onScroll=function(o){if(!o.stickySidebar.is(":visible")){return;}
if($('body').width()<o.options.minWidth){resetSidebar();return;}
if(o.sidebar.outerWidth(true)+50>o.container.width()){resetSidebar();return;}
var scrollTop=$(document).scrollTop();var position='static';if(scrollTop>=o.container.offset().top+(o.paddingTop+o.marginTop-o.options.additionalMarginTop)){var offsetTop=o.paddingTop+o.marginTop+options.additionalMarginTop;var offsetBottom=o.paddingBottom+o.marginBottom+options.additionalMarginBottom;var containerTop=o.container.offset().top;var containerBottom=o.container.offset().top+getClearedHeight(o.container);var windowOffsetTop=0+options.additionalMarginTop;var windowOffsetBottom;var sidebarSmallerThanWindow=(o.stickySidebar.outerHeight()+offsetTop+offsetBottom)<$(window).height();if(sidebarSmallerThanWindow){windowOffsetBottom=windowOffsetTop+o.stickySidebar.outerHeight();}
else{windowOffsetBottom=$(window).height()-o.marginBottom-o.paddingBottom-options.additionalMarginBottom;}
var staticLimitTop=containerTop-scrollTop+o.paddingTop+o.marginTop;var staticLimitBottom=containerBottom-scrollTop-o.paddingBottom-o.marginBottom;var top=o.stickySidebar.offset().top-scrollTop;var scrollTopDiff=o.previousScrollTop-scrollTop;if(o.stickySidebar.css('position')=='fixed'){top+=scrollTopDiff;}
if(scrollTopDiff>0){top=Math.min(top,windowOffsetTop);}
else{top=Math.max(top,windowOffsetBottom-o.stickySidebar.outerHeight());}
top=Math.max(top,staticLimitTop);top=Math.min(top,staticLimitBottom-o.stickySidebar.outerHeight());var sidebarSameHeightAsContainer=o.container.height()==o.stickySidebar.outerHeight();if(!sidebarSameHeightAsContainer&&top==windowOffsetTop){position='fixed';}
else if(!sidebarSameHeightAsContainer&&top==windowOffsetBottom-o.stickySidebar.outerHeight()){position='fixed';}
else if(scrollTop+top-o.sidebar.offset().top-o.paddingTop<=options.additionalMarginTop){position='fixed';}
else{position='absolute';}}
if(position=='fixed'){o.stickySidebar.css({'position':'fixed','width':o.sidebar.width(),'top':top,'left':o.sidebar.offset().left+parseInt(o.sidebar.css('padding-left'))});}
else if(position=='absolute'){var css={};if(o.stickySidebar.css('position')!='absolute'){css.position='absolute';css.top=scrollTop+top-o.sidebar.offset().top-o.stickySidebarPaddingTop-o.stickySidebarPaddingBottom;}
css.width=o.sidebar.width();css.left='';o.stickySidebar.css(css);}
else if(position=='static'){resetSidebar();}
if(position!='static'){if(o.options.updateSidebarHeight==true){o.sidebar.css({'min-height':o.stickySidebar.outerHeight()+o.stickySidebar.offset().top-o.sidebar.offset().top+o.paddingBottom});}}
o.previousScrollTop=scrollTop;};o.onScroll(o);$(document).scroll(function(o){return function(){o.onScroll(o);};}(o));$(window).resize(function(o){return function(){o.stickySidebar.css({'position':'fixed'});o.onScroll(o);};}(o));function resetSidebar(){o.fixedScrollTop=0;o.sidebar.css({'min-height':'1px'});o.stickySidebar.css({'position':'fixed','width':''});}
function getClearedHeight(e){var height=e.height();e.children().each(function(){height=Math.max(height,$(this).height());});return height;}});}})(jQuery);

/* mousetrap v1.6.0 craig.is/killing/mice */
(function(r,t,g){function u(a,b,h){a.addEventListener?a.addEventListener(b,h,!1):a.attachEvent("on"+b,h)}function y(a){if("keypress"==a.type){var b=String.fromCharCode(a.which);a.shiftKey||(b=b.toLowerCase());return b}return k[a.which]?k[a.which]:p[a.which]?p[a.which]:String.fromCharCode(a.which).toLowerCase()}function D(a){var b=[];a.shiftKey&&b.push("shift");a.altKey&&b.push("alt");a.ctrlKey&&b.push("ctrl");a.metaKey&&b.push("meta");return b}function v(a){return"shift"==a||"ctrl"==a||"alt"==a||"meta"==a}function z(a,b){var h,c,e,g=[];h=a;"+"===h?h=["+"]:(h=h.replace(/\+{2}/g,"+plus"),h=h.split("+"));for(e=0;e<h.length;++e)c=h[e],A[c]&&(c=A[c]),b&&"keypress"!=b&&B[c]&&(c=B[c],g.push("shift")),v(c)&&g.push(c);h=c;e=b;if(!e){if(!n){n={};for(var l in k)95<l&&112>l||k.hasOwnProperty(l)&&(n[k[l]]=l)}e=n[h]?"keydown":"keypress"}"keypress"==e&&g.length&&(e="keydown");return{key:c,modifiers:g,action:e}}function C(a,b){return null===a||a===t?!1:a===b?!0:C(a.parentNode,b)}function c(a){function b(a){a=a||{};var b=!1,m;for(m in n)a[m]?b=!0:n[m]=0;b||(w=!1)}function h(a,b,m,f,c,h){var g,e,k=[],l=m.type;if(!d._callbacks[a])return[];"keyup"==l&&v(a)&&(b=[a]);for(g=0;g<d._callbacks[a].length;++g)if(e=d._callbacks[a][g],(f||!e.seq||n[e.seq]==e.level)&&l==e.action){var q;(q="keypress"==l&&!m.metaKey&&!m.ctrlKey)||(q=e.modifiers,q=b.sort().join(",")===q.sort().join(","));q&&(q=f&&e.seq==f&&e.level==h,(!f&&e.combo==c||q)&&d._callbacks[a].splice(g,1),k.push(e))}return k}function g(a,b,m,f){d.stopCallback(b,b.target||b.srcElement,m,f)||!1!==a(b,m)||(b.preventDefault?b.preventDefault():b.returnValue=!1,b.stopPropagation?b.stopPropagation():b.cancelBubble=!0)}function e(a){"number"!==typeof a.which&&(a.which=a.keyCode);var b=y(a);b&&("keyup"==a.type&&x===b?x=!1:d.handleKey(b,D(a),a))}function k(a,c,m,f){function e(c){return function(){w=c;++n[a];clearTimeout(r);r=setTimeout(b,1E3)}}function h(c){g(m,c,a);"keyup"!==f&&(x=y(c));setTimeout(b,10)}for(var d=n[a]=0;d<c.length;++d){var p=d+1===c.length?h:e(f||z(c[d+1]).action);l(c[d],p,f,a,d)}}function l(a,b,c,f,e){d._directMap[a+":"+c]=b;a=a.replace(/\s+/g," ");var g=a.split(" ");1<g.length?k(a,g,b,c):(c=z(a,c),d._callbacks[c.key]=d._callbacks[c.key]||[],h(c.key,c.modifiers,{type:c.action},f,a,e),d._callbacks[c.key][f?"unshift":"push"]({callback:b,modifiers:c.modifiers,action:c.action,seq:f,level:e,combo:a}))}var d=this;a=a||t;if(!(d instanceof c))return new c(a);d.target=a;d._callbacks={};d._directMap={};var n={},r,x=!1,p=!1,w=!1;d._handleKey=function(a,c,e){var f=h(a,c,e),d;c={};var k=0,l=!1;for(d=0;d<f.length;++d)f[d].seq&&(k=Math.max(k,f[d].level));for(d=0;d<f.length;++d)f[d].seq?f[d].level==k&&(l=!0,c[f[d].seq]=1,g(f[d].callback,e,f[d].combo,f[d].seq)):l||g(f[d].callback,e,f[d].combo);f="keypress"==e.type&&p;e.type!=w||v(a)||f||b(c);p=l&&"keydown"==e.type};d._bindMultiple=function(a,b,c){for(var d=0;d<a.length;++d)l(a[d],b,c)};u(a,"keypress",e);u(a,"keydown",e);u(a,"keyup",e)}if(r){var k={8:"backspace",9:"tab",13:"enter",16:"shift",17:"ctrl",18:"alt",20:"capslock",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"ins",46:"del",91:"meta",93:"meta",224:"meta"},p={106:"*",107:"+",109:"-",110:".",111:"/",186:";",187:"=",188:",",189:"-",190:".",191:"/",192:"`",219:"[",220:"\\",221:"]",222:"'"},B={"~":"`","!":"1","@":"2","#":"3",$:"4","%":"5","^":"6","&":"7","*":"8","(":"9",")":"0",_:"-","+":"=",":":";",'"':"'","<":",",">":".","?":"/","|":"\\"},A={option:"alt",command:"meta","return":"enter",escape:"esc",plus:"+",mod:/Mac|iPod|iPhone|iPad/.test(navigator.platform)?"meta":"ctrl"},n;for(g=1;20>g;++g)k[111+g]="f"+g;for(g=0;9>=g;++g)k[g+96]=g;c.prototype.bind=function(a,b,c){a=a instanceof Array?a:[a];this._bindMultiple.call(this,a,b,c);return this};c.prototype.unbind=function(a,b){return this.bind.call(this,a,function(){},b)};c.prototype.trigger=function(a,b){if(this._directMap[a+":"+b])this._directMap[a+":"+b]({},a);return this};c.prototype.reset=function(){this._callbacks={};this._directMap={};return this};c.prototype.stopCallback=function(a,b){return-1<(" "+b.className+" ").indexOf(" mousetrap ")||C(b,this.target)?!1:"INPUT"==b.tagName||"SELECT"==b.tagName||"TEXTAREA"==b.tagName||b.isContentEditable};c.prototype.handleKey=function(){return this._handleKey.apply(this,arguments)};c.addKeycodes=function(a){for(var b in a)a.hasOwnProperty(b)&&(k[b]=a[b]);n=null};c.init=function(){var a=c(t),b;for(b in a)"_"!==b.charAt(0)&&(c[b]=function(b){return function(){return a[b].apply(a,arguments)}}(b))};c.init();r.Mousetrap=c;"undefined"!==typeof module&&module.exports&&(module.exports=c);"function"===typeof define&&define.amd&&define(function(){return c})}})("undefined"!==typeof window?window:null,"undefined"!==typeof window?document:null);

/*! Lity - v1.5.1 - 2015-12-02
* http://sorgalla.com/lity/
* Copyright (c) 2015 Jan Sorgalla; Licensed MIT 
*/
(function(window,factory){if(typeof define==='function'&&define.amd){define(['jquery'],function($){return factory(window,$);});}else if(typeof module==='object'&&typeof module.exports==='object'){module.exports=factory(window,require('jquery'));}else{window.lity=factory(window,window.jQuery||window.Zepto);}}(typeof window!=="undefined"?window:this,function(window,$){'use strict';var document=window.document;var _win=$(window);var _html=$('html');var _instanceCount=0;var _imageRegexp=/\.(png|jpe?g|gif|svg|webp|bmp|ico|tiff?)(\?\S*)?$/i;var _youtubeRegex=/(youtube(-nocookie)?\.com|youtu\.be)\/(watch\?v=|v\/|u\/|embed\/?)?([\w-]{11})(.*)?/i;var _vimeoRegex=/(vimeo(pro)?.com)\/(?:[^\d]+)?(\d+)\??(.*)?$/;var _googlemapsRegex=/((maps|www)\.)?google\.([^\/\?]+)\/?((maps\/?)?\?)(.*)/i;var _defaultHandlers={image:imageHandler,inline:inlineHandler,iframe:iframeHandler};var _defaultOptions={esc:true,handler:null,template:'<div class="lity" tabindex="-1"><div class="lity-wrap" data-lity-close><div class="lity-loader">Loading...</div><div class="lity-container"><div class="lity-content"></div><button class="lity-close" type="button" title="Close (Esc)" data-lity-close>×</button></div></div></div>'};function globalToggle(){_html[_instanceCount>0?'addClass':'removeClass']('lity-active');}
var transitionEndEvent=(function(){var el=document.createElement('div');var transEndEventNames={WebkitTransition:'webkitTransitionEnd',MozTransition:'transitionend',OTransition:'oTransitionEnd otransitionend',transition:'transitionend'};for(var name in transEndEventNames){if(el.style[name]!==undefined){return transEndEventNames[name];}}
return false;})();function transitionEnd(element){var deferred=$.Deferred();if(!transitionEndEvent){deferred.resolve();}else{element.one(transitionEndEvent,deferred.resolve);setTimeout(deferred.resolve,500);}
return deferred.promise();}
function settings(currSettings,key,value){if(arguments.length===1){return $.extend({},currSettings);}
if(typeof key==='string'){if(typeof value==='undefined'){return typeof currSettings[key]==='undefined'?null:currSettings[key];}
currSettings[key]=value;}else{$.extend(currSettings,key);}
return this;}
function protocol(){return'file:'===window.location.protocol?'http:':'';}
function parseQueryParams(params){var pairs=decodeURI(params).split('&');var obj={},p;for(var i=0,n=pairs.length;i<n;i++){if(!pairs[i]){continue;}
p=pairs[i].split('=');obj[p[0]]=p[1];}
return obj;}
function appendQueryParams(url,params){return url+(url.indexOf('?')>-1?'&':'?')+$.param(params);}
function error(msg){return $('<span class="lity-error"/>').append(msg);}
function imageHandler(target){if(!_imageRegexp.test(target)){return false;}
var img=$('<img src="'+target+'">');var deferred=$.Deferred();var failed=function(){deferred.reject(error('Failed loading image'));};img.on('load',function(){if(this.naturalWidth===0){return failed();}
deferred.resolve(img);}).on('error',failed);return deferred.promise();}
function inlineHandler(target){var el;try{el=$(target);}catch(e){return false;}
if(!el.length){return false;}
var placeholder=$('<span style="display:none !important" class="lity-inline-placeholder"/>');return el.after(placeholder).on('lity:ready',function(e,instance){instance.one('lity:remove',function(){placeholder.before(el.addClass('lity-hide')).remove();});});}
function iframeHandler(target){var matches,url=target;matches=_youtubeRegex.exec(target);if(matches){url=appendQueryParams(protocol()+'//www.youtube'+(matches[2]||'')+'.com/embed/'+matches[4],$.extend({autoplay:1},parseQueryParams(matches[5]||'')));}
matches=_vimeoRegex.exec(target);if(matches){url=appendQueryParams(protocol()+'//player.vimeo.com/video/'+matches[3],$.extend({autoplay:1},parseQueryParams(matches[4]||'')));}
matches=_googlemapsRegex.exec(target);if(matches){url=appendQueryParams(protocol()+'//www.google.'+matches[3]+'/maps?'+matches[6],{output:matches[6].indexOf('layer=c')>0?'svembed':'embed'});}
return'<div class="lity-iframe-container"><iframe frameborder="0" allowfullscreen src="'+url+'"></iframe></div>';}
function lity(options){var _options={},_handlers={},_instance,_content,_ready=$.Deferred().resolve();function keyup(e){if(e.keyCode===27){close();}}
function resize(){var height=document.documentElement.clientHeight?document.documentElement.clientHeight:Math.round(_win.height());_content.css('max-height',Math.floor(height)+'px').trigger('lity:resize',[_instance,popup]);}
function ready(content){if(!_instance){return;}
_content=$(content);_win.on('resize',resize);resize();_instance.find('.lity-loader').each(function(){var el=$(this);transitionEnd(el).always(function(){el.remove();});});_instance.removeClass('lity-loading').find('.lity-content').empty().append(_content);_content.removeClass('lity-hide').trigger('lity:ready',[_instance,popup]);_ready.resolve();}
function init(handler,content,options){_instanceCount++;globalToggle();_instance=$(options.template).addClass('lity-loading').appendTo('body');if(!!options.esc){_win.one('keyup',keyup);}
setTimeout(function(){_instance.addClass('lity-opened lity-'+handler).on('click','[data-lity-close]',function(e){if($(e.target).is('[data-lity-close]')){close();}}).trigger('lity:open',[_instance,popup]);$.when(content).always(ready);},0);}
function open(target,options){var handler,content,handlers=$.extend({},_defaultHandlers,_handlers);if(options.handler&&handlers[options.handler]){content=handlers[options.handler](target,popup);handler=options.handler;}else{var lateHandlers={};$.each(['inline','iframe'],function(i,name){if(handlers[name]){lateHandlers[name]=handlers[name];}
delete handlers[name];});var call=function(name,callback){if(!callback){return true;}
content=callback(target,popup);if(!!content){handler=name;return false;}};$.each(handlers,call);if(!handler){$.each(lateHandlers,call);}}
if(content){_ready=$.Deferred();$.when(close()).done($.proxy(init,null,handler,content,options));}
return!!content;}
function close(){if(!_instance){return;}
var deferred=$.Deferred();_ready.done(function(){_instanceCount--;globalToggle();_win.off('resize',resize).off('keyup',keyup);_content.trigger('lity:close',[_instance,popup]);_instance.removeClass('lity-opened').addClass('lity-closed');var instance=_instance,content=_content;_instance=null;_content=null;transitionEnd(content.add(instance)).always(function(){content.trigger('lity:remove',[instance,popup]);instance.remove();deferred.resolve();});});return deferred.promise();}
function popup(event){if(!event.preventDefault){return popup.open(event);}
var el=$(this);var target=el.data('lity-target')||el.attr('href')||el.attr('src');if(!target){return;}
var options=$.extend({},_defaultOptions,_options,el.data('lity-options')||el.data('lity'));if(open(target,options)){event.preventDefault();}}
popup.handlers=$.proxy(settings,popup,_handlers);popup.options=$.proxy(settings,popup,_options);popup.open=function(target){open(target,$.extend({},_defaultOptions,_options));return popup;};popup.close=function(){close();return popup;};return popup.options(options);}
lity.version='1.5.1';lity.handlers=$.proxy(settings,lity,_defaultHandlers);lity.options=$.proxy(settings,lity,_defaultOptions);$(document).on('click','[data-lity]',lity());$('[data-lity]').css({'cursor':'zoom-in'});return lity;}));

/*
 * Toastr
 * Project: https://github.com/CodeSeven/toastr
 */
;(function(define){define(['jquery'],function($){return(function(){var $container;var listener;var toastId=0;var toastType={error:'error',info:'info',success:'success',warning:'warning'};var toastr={clear:clear,remove:remove,error:error,getContainer:getContainer,info:info,options:{},subscribe:subscribe,success:success,version:'2.1.1',warning:warning};var previousToast;return toastr;function error(message,title,optionsOverride){return notify({type:toastType.error,iconClass:getOptions().iconClasses.error,message:message,optionsOverride:optionsOverride,title:title});}
function getContainer(options,create){if(!options){options=getOptions();}
$container=$('#'+options.containerId);if($container.length){return $container;}
if(create){$container=createContainer(options);}
return $container;}
function info(message,title,optionsOverride){return notify({type:toastType.info,iconClass:getOptions().iconClasses.info,message:message,optionsOverride:optionsOverride,title:title});}
function subscribe(callback){listener=callback;}
function success(message,title,optionsOverride){return notify({type:toastType.success,iconClass:getOptions().iconClasses.success,message:message,optionsOverride:optionsOverride,title:title});}
function warning(message,title,optionsOverride){return notify({type:toastType.warning,iconClass:getOptions().iconClasses.warning,message:message,optionsOverride:optionsOverride,title:title});}
function clear($toastElement,clearOptions){var options=getOptions();if(!$container){getContainer(options);}
if(!clearToast($toastElement,options,clearOptions)){clearContainer(options);}}
function remove($toastElement){var options=getOptions();if(!$container){getContainer(options);}
if($toastElement&&$(':focus',$toastElement).length===0){removeToast($toastElement);return;}
if($container.children().length){$container.remove();}}
function clearContainer(options){var toastsToClear=$container.children();for(var i=toastsToClear.length-1;i>=0;i--){clearToast($(toastsToClear[i]),options);}}
function clearToast($toastElement,options,clearOptions){var force=clearOptions&&clearOptions.force?clearOptions.force:false;if($toastElement&&(force||$(':focus',$toastElement).length===0)){$toastElement[options.hideMethod]({duration:options.hideDuration,easing:options.hideEasing,complete:function(){removeToast($toastElement);}});return true;}
return false;}
function createContainer(options){$container=$('<div/>').attr('id',options.containerId).addClass(options.positionClass).attr('aria-live','polite').attr('role','alert');$container.appendTo($(options.target));return $container;}
function getDefaults(){return{tapToDismiss:true,toastClass:'toast',containerId:'toast-container',debug:false,showMethod:'fadeIn',showDuration:300,showEasing:'swing',onShown:undefined,hideMethod:'fadeOut',hideDuration:1000,hideEasing:'swing',onHidden:undefined,extendedTimeOut:1000,iconClasses:{error:'toast-error',info:'toast-info',success:'toast-success',warning:'toast-warning'},iconClass:'toast-info',positionClass:'toast-top-right',timeOut:5000,titleClass:'toast-title',messageClass:'toast-message',target:'body',closeHtml:'<button type="button">&times;</button>',newestOnTop:true,preventDuplicates:false,progressBar:false};}
function publish(args){if(!listener){return;}
listener(args);}
function notify(map){var options=getOptions();var iconClass=map.iconClass||options.iconClass;if(typeof(map.optionsOverride)!=='undefined'){options=$.extend(options,map.optionsOverride);iconClass=map.optionsOverride.iconClass||iconClass;}
if(shouldExit(options,map)){return;}
toastId++;$container=getContainer(options,true);var intervalId=null;var $toastElement=$('<div/>');var $titleElement=$('<div/>');var $messageElement=$('<div/>');var $progressElement=$('<div/>');var $closeElement=$(options.closeHtml);var progressBar={intervalId:null,hideEta:null,maxHideTime:null};var response={toastId:toastId,state:'visible',startTime:new Date(),options:options,map:map};personalizeToast();displayToast();handleEvents();publish(response);if(options.debug&&console){console.log(response);}
return $toastElement;function personalizeToast(){setIcon();setTitle();setMessage();setCloseButton();setProgressBar();setSequence();}
function handleEvents(){$toastElement.hover(stickAround,delayedHideToast);if(!options.onclick&&options.tapToDismiss){$toastElement.click(hideToast);}
if(options.closeButton&&$closeElement){$closeElement.click(function(event){if(event.stopPropagation){event.stopPropagation();}else if(event.cancelBubble!==undefined&&event.cancelBubble!==true){event.cancelBubble=true;}
hideToast(true);});}
if(options.onclick){$toastElement.click(function(){options.onclick();hideToast();});}}
function displayToast(){$toastElement.hide();$toastElement[options.showMethod]({duration:options.showDuration,easing:options.showEasing,complete:options.onShown});if(options.timeOut>0){intervalId=setTimeout(hideToast,options.timeOut);progressBar.maxHideTime=parseFloat(options.timeOut);progressBar.hideEta=new Date().getTime()+progressBar.maxHideTime;if(options.progressBar){progressBar.intervalId=setInterval(updateProgress,10);}}}
function setIcon(){if(map.iconClass){$toastElement.addClass(options.toastClass).addClass(iconClass);}}
function setSequence(){if(options.newestOnTop){$container.prepend($toastElement);}else{$container.append($toastElement);}}
function setTitle(){if(map.title){$titleElement.append(map.title).addClass(options.titleClass);$toastElement.append($titleElement);}}
function setMessage(){if(map.message){$messageElement.append(map.message).addClass(options.messageClass);$toastElement.append($messageElement);}}
function setCloseButton(){if(options.closeButton){$closeElement.addClass('toast-close-button').attr('role','button');$toastElement.prepend($closeElement);}}
function setProgressBar(){if(options.progressBar){$progressElement.addClass('toast-progress');$toastElement.prepend($progressElement);}}
function shouldExit(options,map){if(options.preventDuplicates){if(map.message===previousToast){return true;}else{previousToast=map.message;}}
return false;}
function hideToast(override){if($(':focus',$toastElement).length&&!override){return;}
clearTimeout(progressBar.intervalId);return $toastElement[options.hideMethod]({duration:options.hideDuration,easing:options.hideEasing,complete:function(){removeToast($toastElement);if(options.onHidden&&response.state!=='hidden'){options.onHidden();}
response.state='hidden';response.endTime=new Date();publish(response);}});}
function delayedHideToast(){if(options.timeOut>0||options.extendedTimeOut>0){intervalId=setTimeout(hideToast,options.extendedTimeOut);progressBar.maxHideTime=parseFloat(options.extendedTimeOut);progressBar.hideEta=new Date().getTime()+progressBar.maxHideTime;}}
function stickAround(){clearTimeout(intervalId);progressBar.hideEta=0;$toastElement.stop(true,true)[options.showMethod]({duration:options.showDuration,easing:options.showEasing});}
function updateProgress(){var percentage=((progressBar.hideEta-(new Date().getTime()))/progressBar.maxHideTime)*100;$progressElement.width(percentage+'%');}}
function getOptions(){return $.extend({},getDefaults(),toastr.options);}
function removeToast($toastElement){if(!$container){$container=getContainer();}
if($toastElement.is(':visible')){return;}
$toastElement.remove();$toastElement=null;if($container.children().length===0){$container.remove();previousToast=undefined;}}})();});}(typeof define==='function'&&define.amd?define:function(deps,factory){if(typeof module!=='undefined'&&module.exports){module.exports=factory(require('jquery'));}else{window['toastr']=factory(window['jQuery']);}}));
