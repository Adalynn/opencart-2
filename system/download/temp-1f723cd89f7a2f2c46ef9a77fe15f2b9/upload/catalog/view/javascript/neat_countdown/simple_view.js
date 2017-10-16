!function(e){function t(n){if(r[n])return r[n].exports;var i=r[n]={i:n,l:!1,exports:{}};return e[n].call(i.exports,i,i.exports,t),i.l=!0,i.exports}var r={};t.m=e,t.c=r,t.d=function(e,r,n){t.o(e,r)||Object.defineProperty(e,r,{configurable:!1,enumerable:!0,get:n})},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=0)}([function(e,t,r){function n(e){var t=e.$elems;t.removeClass("ntcd-simple__invisible");var r={text:t.find(".ntcd-simple--text"),days:t.find(".ntcd-simple--days"),hours:t.find(".ntcd-simple--hours"),mins:t.find(".ntcd-simple--mins"),secs:t.find(".ntcd-simple--secs"),render:function(e){var t=e.expired,n=e.days,i=e.hours,o=e.mins,s=e.secs;t&&r.text.text(NTCD.simple.lang.expired),r.prev.days!=n&&r.days.text(n),r.prev.hours!=i&&r.hours.text(u.padLeft(i,2)),r.prev.mins!=o&&r.mins.text(u.padLeft(o,2)),r.prev.secs!=s&&r.secs.text(u.padLeft(s,2)),r.prev=e},prev:{expired:!1,days:NaN,hours:NaN,mins:NaN,secs:NaN}};return new s.default(1e3*e.end_time,r.render,e.delta)}var i=this&&this.__extends||function(){var e=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var r in t)t.hasOwnProperty(r)&&(e[r]=t[r])};return function(t,r){function n(){this.constructor=t}e(t,r),t.prototype=null===r?Object.create(r):(n.prototype=r.prototype,new n)}}();t.__esModule=!0;var o=r(1),s=r(2),u=r(3);new(function(e){function t(){return e.call(this,"simple",".ntcd-simple",n)||this}return i(t,e),t}(o.default))},function(e,t){function r(e,t,r,i){var o="[Neat Countdown]";return"jQuery"in window?(jQuery(function(){if("NTCD"in window){var i=NTCD[e];i.builtInsts||n(i,jQuery(t),r)}else console.error(o+" No NTCD object.")}),!0):(i&&console.error(o+" No jQuery."),!1)}function n(e,t,r){var n=e.builtInsts=Object.create(null),o=e.insts,s=(new Date).getTime();t.each(function(e,t){var r=jQuery(t),i=r.data("inst");if(n[i])return void n[i].elems.push(t);var u=Object.create(o[i]);if(u.elems=[t],u.delta=0,"combo"==u.type||"server"==u.type){var a=s-1e3*u.server_time-3e3,c=Math.abs(a)>1e3*u.critdiff,f="server"==u.type||"combo"==u.type&&c;u.delta=f?a:0}n[i]=u});for(var u=0,a=Object.keys(n);u<a.length;u++){var c=a[u],f=n[c];f.$elems=jQuery(f.elems);i(f,r(f))}}function i(e,t){if(window.IntersectionObserver){var r=e.elems.length,n=0,i=new IntersectionObserver(function(e){r=e.reduce(function(e,t){return e+(t.intersectionRatio>0?n:-1)},r),r?t.start():t.stop(),n||(n=1)});e.elems.forEach(function(e){return i.observe(e)})}else t.start()}t.__esModule=!0;var o=function(){function e(e,t,n){r(e,t,n)||window.addEventListener("load",function(){return r(e,t,n,!0)},!1)}return e}();t.default=o},function(e,t){t.__esModule=!0;var r=function(){function e(e,t,r){this.endTime=e,this.renderFn=t,this.clientServerDelta=r,this.started=!1}return e.prototype.timerCb=function(){var e=this,t=this.calcRemain();this.render(t),t.expired?this.stop():this.timeoutID=setTimeout(function(){return e.timerCb()},this.calcDelay(new Date))},e.prototype.calcDelay=function(e){return(1e3-e.getMilliseconds()+this.clientServerDelta)%1e3||1e3},e.prototype.start=function(){this.started||(this.started=!0,this.timerCb())},e.prototype.stop=function(){this.started&&(this.started=!1,clearTimeout(this.timeoutID))},e.prototype.render=function(e){this.renderFn(e)},e.prototype.calcRemain=function(){return this._calcRemain(new Date)},e.prototype._calcRemain=function(e){var t=this.endTime-e.getTime()+this.clientServerDelta;if(t>=500){var r=1e3-t%1e3;return r<=500&&(t+=r),{expired:!1,days:Math.floor(t/864e5),hours:Math.floor(t%864e5/36e5),mins:Math.floor(t%36e5/6e4),secs:Math.floor(t%6e4/1e3)}}return{expired:!0,days:0,hours:0,mins:0,secs:0}},e}();t.default=r},function(e,t){function r(e,t){e=String(e);for(var r=t-e.length;r>0;r--)e="0"+e;return e}function n(e,t,r){return o[e](t,r)}t.__esModule=!0,t.padLeft=r;var i=function(e,t){if(11==e||12==e||13==e||14==e)return t[2];switch(e%10){case 1:return t[0];case 2:case 3:case 4:return t[1];default:return t[2]}},o={en:function(e,t){return 1==e?t[0]:t[1]},ru:i,uk:i};t.grammarNumber=n}]);