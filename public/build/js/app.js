!function(t){function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}var e={};n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:o})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},n.p="/public/build/",n(n.s="ET/6")}({"ET/6":function(t,n){new Vue({el:"#app",data:{show:!1},computed:{button:function(){return document.getElementById("button").firstChild}},mounted:function(){var t=this;document.addEventListener("click",function(n){n.target===t.button?t.show=!t.show:!0===t.show&&(t.show=!t.show)})},methods:{test:function(){alert()}}})}});