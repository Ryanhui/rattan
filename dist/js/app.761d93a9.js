(function(e){function t(t){for(var s,l,i=t[0],r=t[1],c=t[2],u=0,m=[];u<i.length;u++)l=i[u],o[l]&&m.push(o[l][0]),o[l]=0;for(s in r)Object.prototype.hasOwnProperty.call(r,s)&&(e[s]=r[s]);d&&d(t);while(m.length)m.shift()();return n.push.apply(n,c||[]),a()}function a(){for(var e,t=0;t<n.length;t++){for(var a=n[t],s=!0,i=1;i<a.length;i++){var r=a[i];0!==o[r]&&(s=!1)}s&&(n.splice(t--,1),e=l(l.s=a[0]))}return e}var s={},o={app:0},n=[];function l(t){if(s[t])return s[t].exports;var a=s[t]={i:t,l:!1,exports:{}};return e[t].call(a.exports,a,a.exports,l),a.l=!0,a.exports}l.m=e,l.c=s,l.d=function(e,t,a){l.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},l.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,t){if(1&t&&(e=l(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(l.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var s in e)l.d(a,s,function(t){return e[t]}.bind(null,s));return a},l.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return l.d(t,"a",t),t},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.p="/";var i=window["webpackJsonp"]=window["webpackJsonp"]||[],r=i.push.bind(i);i.push=t,i=i.slice();for(var c=0;c<i.length;c++)t(i[c]);var d=r;n.push([0,"chunk-vendors"]),a()})({0:function(e,t,a){e.exports=a("56d7")},"016f":function(e,t,a){},"034f":function(e,t,a){"use strict";var s=a("64a9"),o=a.n(s);o.a},"159a":function(e,t,a){"use strict";var s=a("016f"),o=a.n(s);o.a},"16c4":function(e,t,a){},"1c5a":function(e,t,a){},"1c5f":function(e,t,a){"use strict";var s=a("7f57"),o=a.n(s);o.a},"1e07":function(e,t,a){e.exports=a.p+"img/photo2.5ac2949e.jpg"},"230b":function(e,t,a){"use strict";var s=a("1c5a"),o=a.n(s);o.a},"38d6":function(e,t,a){e.exports=a.p+"img/photo4.36719b47.jpg"},"3b20":function(e,t,a){},"3cd6":function(e,t,a){},"56d7":function(e,t,a){"use strict";a.r(t);a("cadf"),a("551c"),a("f751"),a("097d");var s=a("2b0e"),o=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{attrs:{id:"app"}},[a("MainPage",{staticClass:"main-page"})],1)},n=[],l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("el-container",[a("el-header",{staticClass:"no-padding",attrs:{height:"160px"}},[a("MainHeader")],1),a("el-main",{staticClass:"no-padding"},[a("router-view")],1),a("el-footer",{staticClass:"no-padding",attrs:{height:"50px"}},[a("MainFooter")],1)],1)},i=[],r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("el-row",{staticClass:"bg-green"},[a("el-col",{attrs:{span:18}},[a("div",{staticClass:"head-title"},[a("p",{staticClass:"head-title-big"},[e._v("Rattan")]),a("p",{staticClass:"head-title-small"},[e._v("Database of co-expression network with functional modules for rattans")])])]),a("el-col",{attrs:{span:6}})],1),a("el-row",{staticClass:"menu"},[a("el-col",{attrs:{span:2}},[a("div",{staticClass:"meun-item"},[a("router-link",{attrs:{to:"/"}},[e._v("Home")])],1)]),a("el-col",{attrs:{span:2}},[a("div",{staticClass:"meun-item",class:{addColor:e.isInList},on:{mouseenter:function(t){return e.enter()},mouseleave:function(t){return e.leave("title")}}},[e._v("Gbrowser")]),a("ul",{directives:[{name:"show",rawName:"v-show",value:e.show,expression:"show"}],staticClass:"gbrowser-dropdown",staticStyle:{width:"210px"},on:{mouseenter:function(t){return e.enterList()},mouseleave:function(t){return e.leave()}}},[a("li",{staticStyle:{"border-bottom":"1px solid white"}},[a("router-link",{attrs:{to:"/gbrowser1"}},[e._v("Calamus simplicifolius")])],1),a("li",[a("router-link",{attrs:{to:"/gbrowser2"}},[e._v("Daemonorops jenkinsiana")])],1)])]),a("el-col",{attrs:{span:2}},[a("div",{staticClass:"meun-item"},[a("router-link",{attrs:{to:"/blast"}},[e._v("Blast")])],1)]),a("el-col",{attrs:{span:2}},[a("div",{staticClass:"meun-item"},[a("router-link",{attrs:{to:"/download"}},[e._v("Download")])],1)]),a("el-col",{attrs:{span:2}},[a("div",{staticClass:"meun-item",class:{addColor:e.isInToolsList},on:{mouseenter:function(t){return e.enterTools()},mouseleave:function(t){return e.leaveTools("title")}}},[e._v("Tools")]),a("ul",{directives:[{name:"show",rawName:"v-show",value:e.showTools,expression:"showTools"}],staticClass:"gbrowser-dropdown",staticStyle:{width:"200px"},on:{mouseenter:function(t){return e.enterToolsList()},mouseleave:function(t){return e.leaveTools()}}},[a("li",{staticClass:"tools-dropdown-list"},[a("router-link",{attrs:{to:"/"}},[e._v("Annotation")])],1),a("li",{staticClass:"tools-dropdown-list"},[a("router-link",{attrs:{to:"/"}},[e._v("Search")])],1),a("li",{staticClass:"tools-dropdown-list"},[a("router-link",{attrs:{to:"/tools/coexpression"}},[e._v("Co-expression Network")])],1),a("li",{staticClass:"tools-dropdown-list"},[a("router-link",{attrs:{to:"/"}},[e._v("Module enrichment")])],1),a("li",{staticClass:"tools-dropdown-list"},[a("router-link",{attrs:{to:"/"}},[e._v("Cis-element Analysis")])],1),a("li",{staticClass:"tools-dropdown-list"},[a("router-link",{attrs:{to:"/tools/genesetsanalysis"}},[e._v("Gene Sets Analysis")])],1),a("li",[a("router-link",{attrs:{to:"/"}},[e._v("Annotation Summary")])],1)])]),a("el-col",{attrs:{span:2}},[a("div",{staticClass:"meun-item"},[a("router-link",{attrs:{to:"/contact"}},[e._v("Contact Us")])],1)]),a("el-col",{attrs:{span:12}})],1)],1)},c=[],d={name:"MainHeader",data:function(){return{show:!1,isInList:!1,showTools:!1,isInToolsList:!1}},methods:{enter:function(){this.show=!0},enterTools:function(){this.showTools=!0},enterList:function(){this.isInList=!0},enterToolsList:function(){this.isInToolsList=!0},leave:function(e){if("title"===e){var t=this;setTimeout(function(){t.isInList||(t.show=!1,t.isInList=!1)},100)}else this.show=!1,this.isInList=!1},leaveTools:function(e){if("title"===e){var t=this;setTimeout(function(){t.isInToolsList||(t.showTools=!1,t.isInToolsList=!1)},100)}else this.showTools=!1,this.isInToolsList=!1}}},u=d,m=(a("e96e"),a("2877")),h=Object(m["a"])(u,r,c,!1,null,null,null),p=h.exports,f=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"main-footer"},[a("el-row",[a("el-col",{attrs:{span:12}},[a("div",{staticClass:"copyright"},[a("p",[e._v("版权所有 © 2004-2019 国际竹藤中心 | International center for bamboo and rattan")])])]),a("el-col",{attrs:{span:12}},[a("div",{staticClass:"pv"})])],1)],1)},g=[],b={name:"MainFooter"},v=b,y=(a("1c5f"),Object(m["a"])(v,f,g,!1,null,null,null)),_=y.exports,w={name:"MainPage",components:{MainHeader:p,MainFooter:_}},k=w,x=(a("b805"),Object(m["a"])(k,l,i,!1,null,"fb7bc7c0",null)),C=x.exports,G={name:"app",components:{MainPage:C}},S=G,V=(a("034f"),Object(m["a"])(S,o,n,!1,null,null,null)),P=V.exports,O=(a("3cd6"),a("5c96")),j=a.n(O);s["default"].use(j.a);var A=a("8c4f"),L=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"body-wrapper"},[a("div",[a("el-carousel",{attrs:{height:"450px"}},e._l(e.photos,function(e){return a("el-carousel-item",{key:e},[a("img",{attrs:{src:e,width:"1168"}})])}),1),a("el-row",{staticClass:"body-content-wrapper"},[a("el-col",{attrs:{span:18}},[a("div",{staticClass:"body-content introduction"},[a("p",{staticClass:"introductio-text"},[e._v(" \n            Rattan is the name for roughly 600 species of old world climbing \n            palms belonging to subfamily Calamoideae. \n            More than 5million people depend economically on rattan, \n            and approximately 7 billion US dollars per year are made in \n            the rattan industry, including domestic industrial production, \n            the international cane Trade, cane splitting, plaiting materials, \n            baskets, seats, and furniture. With the release of two rattan \n            genomes in 2018, their functional annotations were put on the agenda. \n            Rattan-NET aims to build a rattan co-expression network and load \n            a range of analytical tools to functionally annotate rattan's genes \n            to help researchers. More data will be available during the \n            Announcing theGenome Atlas of Bamboo and Rattan (GABR) project, \n            and the functionality will be improved.\n            ")])])]),a("el-col",{attrs:{span:6}},[a("div",{ref:"scriptHolder",staticClass:"body-content news"},[a("div",{staticStyle:{height:"260px"}},[e._v("There are news")]),a("a",{attrs:{href:"https://www.revolvermaps.com/livestats/5pplwzj355p/"}},[a("img",{staticStyle:{border:"0"},attrs:{src:"//rf.revolvermaps.com/h/m/a/0/ff0000/128/0/5pplwzj355p.png",width:"256",height:"128",alt:"Map"}})])])])],1)],1)])},E=[],B={name:"MainBody",components:{},data:function(){return{photos:{photo1:a("789a"),photo2:a("1e07"),photo3:a("69a85"),photo4:a("38d6")}}}},T=B,N=(a("8b71"),Object(m["a"])(T,L,E,!1,null,null,null)),$=N.exports,M=function(){var e=this,t=e.$createElement;e._self._c;return e._m(0)},I=[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("iframe",{staticStyle:{border:"none"},attrs:{src:"http://114.112.125.58/cgi-bin/gb2/gbrowse/Calsi/",width:"1200",height:"1200"}})])}],H={name:"Gbrowser",components:{}},R=H,D=(a("a8c7"),Object(m["a"])(R,M,I,!1,null,"2b7a10d8",null)),z=D.exports,W=function(){var e=this,t=e.$createElement;e._self._c;return e._m(0)},F=[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("iframe",{staticStyle:{border:"none"},attrs:{src:"http://114.112.125.58/cgi-bin/gb2/gbrowse/Daeje/",width:"1200",height:"1200"}})])}],q={name:"Gbrowser",components:{}},J=q,K=(a("230b"),Object(m["a"])(J,W,F,!1,null,"704d3bb8",null)),U=K.exports,Z=function(){var e=this,t=e.$createElement;e._self._c;return e._m(0)},Q=[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("iframe",{staticStyle:{border:"none"},attrs:{src:"http://114.112.125.58:8060/",width:"1200",height:"700"}})])}],X={name:"Blast",components:{}},Y=X,ee=(a("69cf"),Object(m["a"])(Y,Z,Q,!1,null,"a24ca550",null)),te=ee.exports,ae=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("el-row",[a("el-col",{attrs:{span:12}},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tableData1}},[a("el-table-column",{attrs:{prop:"name",label:"name",width:"380"}}),a("el-table-column",{attrs:{prop:"address",label:"Download"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-button",{attrs:{type:"primary",plain:"",size:"small",icon:"el-icon-download"},on:{click:function(a){return e.download(t.row)}}})]}}])})],1)],1),a("el-col",{attrs:{span:12}},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tableData2}},[a("el-table-column",{attrs:{prop:"name",label:"name",width:"380"}}),a("el-table-column",{attrs:{prop:"address",label:"Download"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-button",{attrs:{type:"primary",plain:"",size:"small",icon:"el-icon-download"},on:{click:function(a){return e.download(t.row)}}})]}}])})],1)],1)],1)],1)},se=[],oe=(a("7f7f"),{name:"Download",components:{},data:function(){return{tableData1:[{name:"Phyllostachys_edulis_V1.BAC-ends",address:"/BambooV1/Phyllostachys_edulis_V1.BAC-ends"},{name:"Phyllostachys_edulis_V1.Gene-clusters",address:"/BambooV1/Phyllostachys_edulis_V1.Gene-clusters"},{name:"Phyllostachys_edulis_V1.Interpro",address:"/BambooV1/Phyllostachys_edulis_V1.Interpro"},{name:"Phyllostachys_edulis_V1.Repeats",address:"/BambooV1/Phyllostachys_edulis_V1.Repeats"},{name:"Phyllostachys_edulis_V1.cds",address:"/BambooV1/Phyllostachys_edulis_V1.cds"},{name:"Phyllostachys_edulis_V1.genome",address:"/BambooV1/Phyllostachys_edulis_V1.genome"},{name:"Phyllostachys_edulis_V1.gff",address:"/BambooV1/Phyllostachys_edulis_V1.gff"},{name:"Phyllostachys_edulis_V1.miRNA",address:"/BambooV1/Phyllostachys_edulis_V1.miRNA"},{name:"Phyllostachys_edulis_V1.pep",address:"/BambooV1/Phyllostachys_edulis_V1.pep"},{name:"Phyllostachys_edulis_V1.rRNA",address:"/BambooV1/Phyllostachys_edulis_V1.rRNA"}],tableData2:[{name:"Phyllostachys_edulis_V2.Hic.cds",address:"/BambooV2/Phyllostachys_edulis_V2.Hic.cds"},{name:"Phyllostachys_edulis_V2.Hic.genome",address:"/BambooV2/Phyllostachys_edulis_V2.Hic.genome"},{name:"Phyllostachys_edulis_V2.Hic.gff",address:"/BambooV2/Phyllostachys_edulis_V2.Hic.gff"},{name:"Phyllostachys_edulis_V2.Hic.pep",address:"/BambooV2/Phyllostachys_edulis_V2.Hic.pep"},{name:"Phyllostachys_edulis_V2.WGS.genome",address:"/BambooV2/Phyllostachys_edulis_V2.WGS.genome"},{name:"Phyllostachys_edulis_V2.WGS.gff3",address:"/BambooV2/Phyllostachys_edulis_V2.WGS.gff3"},{name:"Phyllostachys_edulis_V2.WGS.miRNA.gff",address:"/BambooV2/Phyllostachys_edulis_V2.WGS.miRNA.gff"},{name:"Phyllostachys_edulis_V2.WGS.rRNA.gff",address:"/BambooV2/Phyllostachys_edulis_V2.WGS.rRNA.gff"},{name:"Phyllostachys_edulis_V2.WGS.snRNA.gff",address:"/BambooV2/Phyllostachys_edulis_V2.WGS.snRNA.gff"},{name:"Phyllostachys_edulis_V2.WGS.tRNA.gff",address:"/BambooV2/Phyllostachys_edulis_V2.WGS.tRNA.gff"}]}},methods:{download:function(e){var t=document.createElement("a");t.download=e.name,t.style.display="none",t.href=e.address,document.body.appendChild(t),t.click(),document.body.removeChild(t)}}}),ne=oe,le=(a("c7bb"),Object(m["a"])(ne,ae,se,!1,null,"d22af030",null)),ie=le.exports,re=function(){var e=this,t=e.$createElement;e._self._c;return e._m(0)},ce=[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("p",{staticClass:"content",staticStyle:{"font-size":"32px","margin-top":"64px"}},[e._v("How to contact us ?")]),a("p",{staticClass:"content",staticStyle:{"margin-top":"32px"}},[e._v("If you have any questions or Suggestions, ")]),a("p",{staticClass:"content"},[e._v("please email us to jiongliangw@163.com")])])}],de={name:"Contact",components:{}},ue=de,me=(a("9531"),Object(m["a"])(ue,re,ce,!1,null,"7ef61715",null)),he=me.exports,pe=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("div",{staticClass:"pannel"},[a("p",{staticClass:"title"},[e._v("Co-expression network analysis")]),e.show?a("div",{attrs:{id:"holder"}},[a("cytoscape",{attrs:{config:e.config}}),a("span",{staticStyle:{"font-size":"14px",margin:"0 0 24px 120px"},on:{click:e.exportToImg}},[e._v("Export to img")])],1):e._e(),a("el-tabs",{staticClass:"tabs",attrs:{type:"border-card",stretch:""},on:{"tab-click":e.handleTabClick},model:{value:e.form.activeName,callback:function(t){e.$set(e.form,"activeName",t)},expression:"form.activeName"}},[a("el-tab-pane",{attrs:{label:"Calsi",name:"calsi"}},[a("el-form",{ref:"form",staticClass:"form",attrs:{model:e.form,"label-width":"120px"}},[a("el-form-item",{attrs:{label:"Single Or List"}},[a("el-radio-group",{model:{value:e.form.singleOrList,callback:function(t){e.$set(e.form,"singleOrList",t)},expression:"form.singleOrList"}},[a("el-radio",{attrs:{label:"single"}}),a("el-radio",{attrs:{label:"list"}})],1)],1),a("el-form-item",{directives:[{name:"show",rawName:"v-show",value:"single"===e.form.singleOrList,expression:"form.singleOrList === 'single'"}],attrs:{label:"Single gene",required:""}},[a("el-input",{model:{value:e.form.gene,callback:function(t){e.$set(e.form,"gene",t)},expression:"form.gene"}}),a("span",[e._v("Example: Calsi_gene44939")])],1),a("el-form-item",{directives:[{name:"show",rawName:"v-show",value:"list"===e.form.singleOrList,expression:"form.singleOrList === 'list'"}],attrs:{label:"List of genes",required:""}},[a("el-input",{attrs:{type:"textarea",rows:"5"},model:{value:e.form.genes,callback:function(t){e.$set(e.form,"genes",t)},expression:"form.genes"}}),a("span",{staticStyle:{cursor:"pointer"},on:{click:e.addExample}},[e._v("Example: Calsi")])],1),a("el-form-item",{attrs:{label:"Type"}},[a("el-radio-group",{model:{value:e.form.type,callback:function(t){e.$set(e.form,"type",t)},expression:"form.type"}},[a("el-radio",{attrs:{label:"Positive"}}),a("el-radio",{attrs:{label:"Negative"}}),a("el-radio",{attrs:{label:"All"}})],1)],1),a("el-form-item",[a("el-button",{staticStyle:{"margin-left":"28px"},attrs:{type:"primary",loading:e.loading},on:{click:e.onSubmit}},[e._v("Search")])],1)],1)],1),a("el-tab-pane",{attrs:{label:"Daeje",name:"daeje"}},[a("el-form",{ref:"form",staticClass:"form",attrs:{model:e.form,"label-width":"120px"}},[a("el-form-item",{attrs:{label:"Single Or List"}},[a("el-radio-group",{model:{value:e.form.singleOrList,callback:function(t){e.$set(e.form,"singleOrList",t)},expression:"form.singleOrList"}},[a("el-radio",{attrs:{label:"single"}}),a("el-radio",{attrs:{label:"list"}})],1)],1),a("el-form-item",{directives:[{name:"show",rawName:"v-show",value:"single"===e.form.singleOrList,expression:"form.singleOrList === 'single'"}],attrs:{label:"Single gene",required:""}},[a("el-input",{model:{value:e.form.gene,callback:function(t){e.$set(e.form,"gene",t)},expression:"form.gene"}}),a("span",[e._v("Example: Daeje_Gene46292")])],1),a("el-form-item",{directives:[{name:"show",rawName:"v-show",value:"list"===e.form.singleOrList,expression:"form.singleOrList === 'list'"}],attrs:{label:"List of genes",required:""}},[a("el-input",{attrs:{type:"textarea",rows:"5"},model:{value:e.form.genes,callback:function(t){e.$set(e.form,"genes",t)},expression:"form.genes"}}),a("span",{staticStyle:{cursor:"pointer"},on:{click:e.addExample}},[e._v("Example: daeje")])],1),a("el-form-item",{attrs:{label:"Type"}},[a("el-radio-group",{model:{value:e.form.type,callback:function(t){e.$set(e.form,"type",t)},expression:"form.type"}},[a("el-radio",{attrs:{label:"Positive"}}),a("el-radio",{attrs:{label:"Negative"}}),a("el-radio",{attrs:{label:"All"}})],1)],1),a("el-form-item",[a("el-button",{staticStyle:{"margin-left":"28px"},attrs:{type:"primary",loading:e.loading},on:{click:e.onSubmit}},[e._v("Search")])],1)],1)],1)],1)],1)])},fe=[],ge=(a("a481"),a("ac6a"),{elements:[],minZoom:1,style:[{selector:"node",style:{width:"10px",height:"10px","background-color":"#9baec8",label:"data(id)","font-size":"4px"}},{selector:"node[?isRoot]",style:{"background-color":"#2b90d9"}},{selector:"edge[length > 0]",style:{width:.3,"line-color":"#566270","target-arrow-color":"#566270","target-arrow-shape":"triangle"}},{selector:"edge[length < 0]",style:{width:.3,"line-color":"#F68657","target-arrow-color":"#F68657","target-arrow-shape":"triangle"}}],layout:{name:"concentric",fit:!0,padding:30,startAngle:1.5*Math.PI,sweep:void 0,clockwise:!0,equidistant:!1,minNodeSpacing:10,boundingBox:void 0,avoidOverlap:!0,nodeDimensionsIncludeLabels:!1,height:void 0,width:void 0,spacingFactor:void 0,concentric:function(e){return e.degree()},levelWidth:function(e){return e.maxDegree()/4},animate:!1,animationDuration:500,animationEasing:void 0,animateFilter:function(e,t){return!0},ready:void 0,stop:void 0,transform:function(e,t){return t}}}),be={name:"CoExpression",components:{},data:function(){return{config:ge,i:0,elements:[],loading:!1,show:!1,form:{activeName:"calsi",singleOrList:"single",gene:"",genes:"",type:"Positive"}}},methods:{addExample:function(){"calsi"===this.form.activeName?this.form.genes="Calsi_gene46977 \nCalsi_gene44939 \nCalsi_gene13781":this.form.genes="Daeje_Gene09510 \nDaeje_Gene00887 \nDaeje_Gene26990"},handleTabClick:function(){this.form.gene="",this.form.genes=""},onSubmit:function(){var e=this;if("single"!==this.form.singleOrList||""!==this.form.gene)if("list"!==this.form.singleOrList||""!==this.form.genes)if("single"===this.form.singleOrList)this.show=!1,this.loading=!0,this.axios.get("http://rattan.bamboogdb.org/php/coExpressionGet.php?gene=".concat(this.form.gene,"&database=").concat(this.form.activeName,"&type=").concat(this.form.type)).then(function(t){var a=t.data;if("no_data"===t.data)return e.$message({message:"No result",type:"error"}),void(e.loading=!1);var s=[];s.push({data:{id:a.root,isRoot:!0}}),a.node.forEach(function(e){s.push({data:{id:e}})}),a.edge.forEach(function(e){s.push({data:{id:e.id,source:e.source,target:e.target,length:e.length}})}),e.elements=s,e.config.elements=s;var o=e;setTimeout(function(){o.show=!0,o.loading=!1},1e3)});else{var t=new FormData;t.append("database",this.form.activeName),t.append("genes",this.form.genes),t.append("type",this.form.type),this.show=!1,this.loading=!0,this.axios.post("http://rattan.bamboogdb.org/php/coExpressionPost.php",t).then(function(t){var a=t.data,s=!1,o=[];if(a.root.forEach(function(t){""===t&&(e.$message({message:"Please check input format",type:"error"}),s=!0),o.push({data:{id:t.replace(/\s/g,""),isRoot:!0}})}),s)e.loading=!1;else{a.node.forEach(function(e){o.push({data:{id:e}})}),a.edge.forEach(function(e){o.push({data:{id:e.id,source:e.source,target:e.target,length:e.length}})}),e.elements=o,e.config.elements=o;var n=e;setTimeout(function(){n.show=!0,n.loading=!1},1e3)}}).catch(function(e){})}else this.$message({message:"Please input genes",type:"error"});else this.$message({message:"Please input gene",type:"error"})},exportToImg:function(){console.log(this.$cytoscape),this.$cytoscape.instance.then(function(e){var t=e.png();function a(e){var t=window.open();t.document.write('<iframe src="'+e+'" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>'),t.document.close()}a(t)})}}},ve=be,ye=(a("91b7"),Object(m["a"])(ve,pe,fe,!1,null,"6aa888c3",null)),_e=ye.exports,we=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"container"},[a("p",{staticClass:"title"},[e._v("GSEA Analysis")]),a("el-form",{ref:"form",staticClass:"form",attrs:{"label-width":"200px"}},[a("el-form-item",{attrs:{label:"Choose Species"}},[a("el-select",{attrs:{placeholder:"please select"},model:{value:e.species,callback:function(t){e.species=t},expression:"species"}},[a("el-option",{attrs:{label:"Calsi",value:"calsi"}}),a("el-option",{attrs:{label:"Daeje",value:"daeje"}})],1)],1),a("el-form-item",{attrs:{label:"Choose Gene Sets"}},[a("div",[a("el-checkbox",{attrs:{indeterminate:e.isIndeterminateG1},on:{change:e.handleCheckAllG1Change},model:{value:e.checkAllG1,callback:function(t){e.checkAllG1=t},expression:"checkAllG1"}},[e._v("G1:GO gene sets")]),a("el-checkbox-group",{staticStyle:{"margin-left":"18px"},on:{change:e.handleCheckedG1Change},model:{value:e.checkedG1,callback:function(t){e.checkedG1=t},expression:"checkedG1"}},[a("el-checkbox",{key:"bp",attrs:{label:"bp"}},[e._v("BP:GO biological process")]),a("el-checkbox",{key:"cc",attrs:{label:"cc"}},[e._v("CC:GO cellular component ")]),a("el-checkbox",{key:"mf",attrs:{label:"mf"}},[e._v("MF:GO molecular function")])],1)],1),a("div",[a("el-checkbox",{model:{value:e.checkedG2,callback:function(t){e.checkedG2=t},expression:"checkedG2"}},[e._v("G2:Gene Family Based gene sets")])],1),a("div",[a("el-checkbox",{attrs:{indeterminate:e.isIndeterminateG3},on:{change:e.handleCheckAllG3Change},model:{value:e.checkAllG3,callback:function(t){e.checkAllG3=t},expression:"checkAllG3"}},[e._v("G3:Curated gene sets")]),a("el-checkbox-group",{staticStyle:{"margin-left":"18px"},on:{change:e.handleCheckedG3Change},model:{value:e.checkedG3,callback:function(t){e.checkedG3=t},expression:"checkedG3"}},[a("el-checkbox",{key:"kegg",attrs:{label:"kegg"}},[e._v("KEGG:KEGG gene sets")])],1)],1)]),a("el-form-item",{attrs:{label:"Choose Background"}},[a("el-select",{attrs:{placeholder:"please select"},model:{value:e.background,callback:function(t){e.background=t},expression:"background"}},[a("el-option",{attrs:{label:"Suggested background (Whole genome level)",value:"suggested"}}),a("el-option",{attrs:{label:"Customized background",value:"customized"}})],1)],1),"customized"===e.background?a("el-form-item",{attrs:{label:"Customized background"}},[a("el-input",{staticStyle:{width:"240px"},attrs:{type:"textarea",rows:5,placeholder:"please input genes"},model:{value:e.customizedBackground,callback:function(t){e.customizedBackground=t},expression:"customizedBackground"}})],1):e._e(),a("el-form-item",{attrs:{label:"Statistical test method"}},[a("el-select",{attrs:{placeholder:"please select"},model:{value:e.testMethod,callback:function(t){e.testMethod=t},expression:"testMethod"}},[a("el-option",{attrs:{label:"Fisher",value:"Fisher"}}),a("el-option",{attrs:{label:"Hypergeometric",value:"Hypergeometric"}}),a("el-option",{attrs:{label:"Chi-square",value:"Chi-square"}})],1)],1),a("el-form-item",{attrs:{label:"Multi-test adjustment method"}},[a("el-select",{attrs:{placeholder:"please select"},model:{value:e.adjustmentMethod,callback:function(t){e.adjustmentMethod=t},expression:"adjustmentMethod"}},[a("el-option",{attrs:{label:"Bonferroni",value:"Bonferroni"}}),a("el-option",{attrs:{label:"Hochberg",value:"Hochberg"}}),a("el-option",{attrs:{label:"Hochberg(FDR)",value:"Hochbergfdr"}}),a("el-option",{attrs:{label:"Hommel",value:"Hommel"}}),a("el-option",{attrs:{label:"Hoim",value:"Hoim"}}),a("el-option",{attrs:{label:"Not adjust",value:"not"}})],1)],1),a("el-form-item",{attrs:{label:"Significance Level"}},[a("el-select",{attrs:{placeholder:"please select"},model:{value:e.level,callback:function(t){e.level=t},expression:"level"}},[a("el-option",{attrs:{label:"0.05",value:"0.05"}}),a("el-option",{attrs:{label:"0.1",value:"0.1"}}),a("el-option",{attrs:{label:"0.01",value:"0.01"}})],1)],1),a("el-form-item",[a("el-input",{staticStyle:{width:"240px"},attrs:{type:"textarea",rows:5,placeholder:"please input genes"},model:{value:e.textarea,callback:function(t){e.textarea=t},expression:"textarea"}})],1),a("el-form-item",[a("el-button",{attrs:{type:"primary"},on:{click:e.onSubmit}},[e._v("Submit")])],1)],1)],1)},ke=[],xe={name:"GeneSetsAnalysis",components:{},data:function(){return{checkAllG1:!1,isIndeterminateG1:!1,checkedG1:[],checkedG2:!1,checkAllG3:!1,isIndeterminateG3:!1,checkedG3:[],species:"",background:"",customizedBackground:"",testMethod:"",adjustmentMethod:"",level:"",textarea:""}},methods:{handleCheckAllG1Change:function(e){console.log(e),this.checkedG1=e?["bp","cc","mf"]:[],this.isIndeterminateG1=!1},handleCheckedG1Change:function(e){console.log(e),this.checkAllG1=3===e.length,this.isIndeterminateG1=e.length>0&&e.length<3},handleCheckAllG3Change:function(e){console.log(e),this.checkedG3=e?["kegg"]:[],this.isIndeterminateG3=!1},handleCheckedG3Change:function(e){console.log(e),this.checkAllG3=1===e.length,this.isIndeterminateG3=e.length>0&&e.length<1},onSubmit:function(){var e=1234;this.axios.post("http://rattan.bamboogdb.org/php/gsea.php",e).then(function(e){console.log(e)}).catch(function(e){console.log(e)})}}},Ce=xe,Ge=(a("159a"),Object(m["a"])(Ce,we,ke,!1,null,"b554b2ea",null)),Se=Ge.exports,Ve=[{path:"/",component:$},{path:"/gbrowser1",component:z},{path:"/gbrowser2",component:U},{path:"/blast",component:te},{path:"/download",component:ie},{path:"/contact",component:he},{path:"/tools/coexpression",component:_e},{path:"/tools/genesetsanalysis",component:Se}],Pe=a("5515"),Oe=a.n(Pe),je=(a("f252"),a("bc3a")),Ae=a.n(je),Le=a("a7fe"),Ee=a.n(Le);s["default"].config.productionTip=!1,s["default"].use(Oe.a),s["default"].use(A["a"]),s["default"].use(Ee.a,Ae.a);var Be=new A["a"]({routes:Ve});new s["default"]({router:Be,render:function(e){return e(P)}}).$mount("#app")},"64a9":function(e,t,a){},"69a85":function(e,t,a){e.exports=a.p+"img/photo3.d7b24887.jpg"},"69cf":function(e,t,a){"use strict";var s=a("f999"),o=a.n(s);o.a},"789a":function(e,t,a){e.exports=a.p+"img/photo1.bafbb3f1.jpg"},"7f57":function(e,t,a){},"8b71":function(e,t,a){"use strict";var s=a("e3a2"),o=a.n(s);o.a},"91b7":function(e,t,a){"use strict";var s=a("99fc"),o=a.n(s);o.a},9531:function(e,t,a){"use strict";var s=a("ea2a"),o=a.n(s);o.a},"99fc":function(e,t,a){},a8c7:function(e,t,a){"use strict";var s=a("c3ef"),o=a.n(s);o.a},b805:function(e,t,a){"use strict";var s=a("fec4"),o=a.n(s);o.a},c3ef:function(e,t,a){},c7bb:function(e,t,a){"use strict";var s=a("16c4"),o=a.n(s);o.a},e3a2:function(e,t,a){},e96e:function(e,t,a){"use strict";var s=a("3b20"),o=a.n(s);o.a},ea2a:function(e,t,a){},f999:function(e,t,a){},fec4:function(e,t,a){}});
//# sourceMappingURL=app.761d93a9.js.map