(function(f){function v(b,c,a,e,d){var g=0;b=c-b;c=Math.abs(b);a=a;if(e==false)a+=d;if(a>0&&c>0.01&&c<6.282)g=parseFloat(a)/2/Math.sin((b-(b-Math.PI)/8/Math.PI)/2);return g}function w(){for(var b=0;b<this.series.length;b++)if(this.series[b].renderer.constructor==f.jqplot.PieRenderer)if(this.series[b].highlightMouseOver)this.series[b].highlightMouseDown=false}function x(){for(var b=0;b<this.series.length;b++){this.series[b].seriesColors=this.seriesColors;this.series[b].colorGenerator=f.jqplot.colorGenerator}}
function u(b,c,a){var e=b.series[c],d=b.plugins.pieRenderer.highlightCanvas;d._ctx.clearRect(0,0,d._ctx.canvas.width,d._ctx.canvas.height);e._highlightedPoint=a;b.plugins.pieRenderer.highlightedSeriesIndex=c;e.renderer.drawSlice.call(e,d._ctx,e._sliceAngles[a][0],e._sliceAngles[a][1],e.highlightColorGenerator.get(a),false)}function r(b){var c=b.plugins.pieRenderer.highlightCanvas;c._ctx.clearRect(0,0,c._ctx.canvas.width,c._ctx.canvas.height);for(c=0;c<b.series.length;c++)b.series[c]._highlightedPoint=
null;b.plugins.pieRenderer.highlightedSeriesIndex=null;b.target.trigger("jqplotDataUnhighlight")}function y(b,c,a,e,d){if(e){c=[e.seriesIndex,e.pointIndex,e.data];a=jQuery.Event("jqplotDataMouseOver");a.pageX=b.pageX;a.pageY=b.pageY;d.target.trigger(a,c);if(d.series[c[0]].highlightMouseOver&&!(c[0]==d.plugins.pieRenderer.highlightedSeriesIndex&&c[1]==d.series[c[0]]._highlightedPoint)){a=jQuery.Event("jqplotDataHighlight");a.which=b.which;a.pageX=b.pageX;a.pageY=b.pageY;d.target.trigger(a,c);u(d,c[0],
c[1])}}else e==null&&r(d)}function z(b,c,a,e,d){if(e){c=[e.seriesIndex,e.pointIndex,e.data];if(d.series[c[0]].highlightMouseDown&&!(c[0]==d.plugins.pieRenderer.highlightedSeriesIndex&&c[1]==d.series[c[0]]._highlightedPoint)){a=jQuery.Event("jqplotDataHighlight");a.which=b.which;a.pageX=b.pageX;a.pageY=b.pageY;d.target.trigger(a,c);u(d,c[0],c[1])}}else e==null&&r(d)}function A(b,c,a,e,d){b=d.plugins.pieRenderer.highlightedSeriesIndex;b!=null&&d.series[b].highlightMouseDown&&r(d)}function B(b,c,a,e,
d){if(e){c=[e.seriesIndex,e.pointIndex,e.data];a=jQuery.Event("jqplotDataClick");a.which=b.which;a.pageX=b.pageX;a.pageY=b.pageY;d.target.trigger(a,c)}}function C(b,c,a,e,d){if(e){c=[e.seriesIndex,e.pointIndex,e.data];a=d.plugins.pieRenderer.highlightedSeriesIndex;a!=null&&d.series[a].highlightMouseDown&&r(d);a=jQuery.Event("jqplotDataRightClick");a.which=b.which;a.pageX=b.pageX;a.pageY=b.pageY;d.target.trigger(a,c)}}function D(){if(this.plugins.pieRenderer&&this.plugins.pieRenderer.highlightCanvas){this.plugins.pieRenderer.highlightCanvas.resetCanvas();
this.plugins.pieRenderer.highlightCanvas=null}this.plugins.pieRenderer={highlightedSeriesIndex:null};this.plugins.pieRenderer.highlightCanvas=new f.jqplot.GenericCanvas;var b=f(this.targetId+" .jqplot-data-label");b.length?f(b[0]).before(this.plugins.pieRenderer.highlightCanvas.createElement(this._gridPadding,"jqplot-pieRenderer-highlight-canvas",this._plotDimensions,this)):this.eventCanvas._elem.before(this.plugins.pieRenderer.highlightCanvas.createElement(this._gridPadding,"jqplot-pieRenderer-highlight-canvas",
this._plotDimensions,this));this.plugins.pieRenderer.highlightCanvas.setContext();this.eventCanvas._elem.bind("mouseleave",{plot:this},function(c){r(c.data.plot)})}f.jqplot.PieRenderer=function(){f.jqplot.LineRenderer.call(this)};f.jqplot.PieRenderer.prototype=new f.jqplot.LineRenderer;f.jqplot.PieRenderer.prototype.constructor=f.jqplot.PieRenderer;f.jqplot.PieRenderer.prototype.init=function(b,c){this.diameter=null;this.padding=20;this.sliceMargin=0;this.fill=true;this.shadowOffset=2;this.shadowAlpha=
0.07;this.shadowDepth=5;this.highlightMouseOver=true;this.highlightMouseDown=false;this.highlightColors=[];this.dataLabels="percent";this.showDataLabels=false;this.dataLabelFormatString=null;this.dataLabelThreshold=3;this.dataLabelPositionFactor=0.52;this.dataLabelNudge=2;this.dataLabelCenterOn=true;this.startAngle=0;this.tickRenderer=f.jqplot.PieTickRenderer;this._drawData=true;this._type="pie";if(b.highlightMouseDown&&b.highlightMouseOver==null)b.highlightMouseOver=false;f.extend(true,this,b);if(this.sliceMargin<
0)this.sliceMargin=0;this._radius=this._diameter=null;this._sliceAngles=[];this._highlightedPoint=null;if(this.highlightColors.length==0)for(var a=0;a<this.seriesColors.length;a++){var e=f.jqplot.getColorComponents(this.seriesColors[a]);e=[e[0],e[1],e[2]];for(var d=e[0]+e[1]+e[2],g=0;g<3;g++){e[g]=d>570?e[g]*0.8:e[g]+0.3*(255-e[g]);e[g]=parseInt(e[g],10)}this.highlightColors.push("rgb("+e[0]+","+e[1]+","+e[2]+")")}this.highlightColorGenerator=new f.jqplot.ColorGenerator(this.highlightColors);c.postParseOptionsHooks.addOnce(x);
c.postInitHooks.addOnce(w);c.eventListenerHooks.addOnce("jqplotMouseMove",y);c.eventListenerHooks.addOnce("jqplotMouseDown",z);c.eventListenerHooks.addOnce("jqplotMouseUp",A);c.eventListenerHooks.addOnce("jqplotClick",B);c.eventListenerHooks.addOnce("jqplotRightClick",C);c.postDrawHooks.addOnce(D)};f.jqplot.PieRenderer.prototype.setGridData=function(){var b=[],c=[],a=0;this._drawData=false;for(var e=0;e<this.data.length;e++){if(this.data[e][1]!=0)this._drawData=true;b.push(this.data[e][1]);c.push([this.data[e][0]]);
if(e>0)b[e]+=b[e-1];a+=this.data[e][1]}var d=Math.PI*2/b[b.length-1];for(e=0;e<b.length;e++){c[e][1]=b[e]*d;c[e][2]=this.data[e][1]/a}this.gridData=c};f.jqplot.PieRenderer.prototype.makeGridData=function(b){var c=[],a=[],e=0;this._drawData=false;for(var d=0;d<b.length;d++){if(this.data[d][1]!=0)this._drawData=true;c.push(b[d][1]);a.push([b[d][0]]);if(d>0)c[d]+=c[d-1];e+=b[d][1]}var g=Math.PI*2/c[c.length-1];for(d=0;d<c.length;d++){a[d][1]=c[d]*g;a[d][2]=b[d][1]/e}return a};f.jqplot.PieRenderer.prototype.drawSlice=
function(b,c,a,e,d){function g(l){if(a>6.282+this.startAngle){a=6.282+this.startAngle;if(c>a)c=6.281+this.startAngle}if(!(c>=a)){b.beginPath();b.fillStyle=e;b.strokeStyle=e;b.lineWidth=j;b.arc(0,0,l,c,a,false);b.lineTo(0,0);b.closePath();m?b.fill():b.stroke()}}if(this._drawData){var h=this._radius,m=this.fill,j=this.lineWidth,i=this.sliceMargin;if(this.fill==false)i+=this.lineWidth;b.save();b.translate(this._center[0],this._center[1]);i=v(c,a,this.sliceMargin,this.fill,this.lineWidth);var q=i*Math.cos((c+
a)/2),n=i*Math.sin((c+a)/2);if(a-c<=Math.PI)h-=i;else h+=i;b.translate(q,n);if(d){d=0;for(i=this.shadowDepth;d<i;d++){b.save();b.translate(this.shadowOffset*Math.cos(this.shadowAngle/180*Math.PI),this.shadowOffset*Math.sin(this.shadowAngle/180*Math.PI));g(h)}d=0;for(i=this.shadowDepth;d<i;d++)b.restore()}else g(h);b.restore()}};f.jqplot.PieRenderer.prototype.draw=function(b,c,a,e){var d=0,g=0,h=1,m=new f.jqplot.ColorGenerator(this.seriesColors);if(a.legendInfo&&a.legendInfo.placement=="insideGrid"){a=
a.legendInfo;switch(a.location){case "nw":d=a.width+a.xoffset;break;case "w":d=a.width+a.xoffset;break;case "sw":d=a.width+a.xoffset;break;case "ne":d=a.width+a.xoffset;h=-1;break;case "e":d=a.width+a.xoffset;h=-1;break;case "se":d=a.width+a.xoffset;h=-1;break;case "n":g=a.height+a.yoffset;break;case "s":g=a.height+a.yoffset;h=-1}}var j=b.canvas.width,i=b.canvas.height,q=Math.min(j-d-2*this.padding,i-g-2*this.padding);this._sliceAngles=[];var n,l=0,o,t,s=this.startAngle/180*Math.PI;a=0;for(var p=
c.length;a<p;a++){o=a==0?s:c[a-1][1]+s;t=c[a][1]+s;this._sliceAngles.push([o,t]);n=v(o,t,this.sliceMargin,this.fill,this.lineWidth);if(Math.abs(t-o)>Math.PI)l=Math.max(n,l)}this._diameter=this.diameter!=null&&this.diameter>0?this.diameter-2*l:q-2*l;if(this._diameter<6)f.jqplot.log("Diameter of pie too small, not rendering.");else{this._radius=this._diameter/2;this._center=[(j-h*d)/2+h*d+l*Math.cos(s),(i-h*g)/2+h*g+l*Math.sin(s)];if(this.shadow){a=0;for(p=c.length;a<p;a++){d="rgba(0,0,0,"+this.shadowAlpha+
")";this.renderer.drawSlice.call(this,b,this._sliceAngles[a][0],this._sliceAngles[a][1],d,true)}}for(a=0;a<c.length;a++){this.renderer.drawSlice.call(this,b,this._sliceAngles[a][0],this._sliceAngles[a][1],m.next(),false);if(this.showDataLabels&&c[a][2]*100>=this.dataLabelThreshold){var k;d=(this._sliceAngles[a][0]+this._sliceAngles[a][1])/2;if(this.dataLabels=="label"){k=this.dataLabelFormatString||"%s";k=f.jqplot.sprintf(k,c[a][0])}else if(this.dataLabels=="value"){k=this.dataLabelFormatString||
"%d";k=f.jqplot.sprintf(k,this.data[a][1])}else if(this.dataLabels=="percent"){k=this.dataLabelFormatString||"%d%%";k=f.jqplot.sprintf(k,c[a][2]*100)}else if(this.dataLabels.constructor==Array){k=this.dataLabelFormatString||"%s";k=f.jqplot.sprintf(k,this.dataLabels[a])}h=this._radius*this.dataLabelPositionFactor+this.sliceMargin+this.dataLabelNudge;g=this._center[0]+Math.cos(d)*h+this.canvas._offsets.left;h=this._center[1]+Math.sin(d)*h+this.canvas._offsets.top;p=f('<div class="jqplot-pie-series jqplot-data-label" style="position:absolute;">'+
k+"</div>").insertBefore(e.eventCanvas._elem);g-=this.dataLabelCenterOn?p.width()/2:p.width()*Math.sin(d/2);h-=p.height()/2;g=Math.round(g);h=Math.round(h);p.css({left:g,top:h})}}}};f.jqplot.PieAxisRenderer=function(){f.jqplot.LinearAxisRenderer.call(this)};f.jqplot.PieAxisRenderer.prototype=new f.jqplot.LinearAxisRenderer;f.jqplot.PieAxisRenderer.prototype.constructor=f.jqplot.PieAxisRenderer;f.jqplot.PieAxisRenderer.prototype.init=function(b){this.tickRenderer=f.jqplot.PieTickRenderer;f.extend(true,
this,b);this._dataBounds={min:0,max:100};this.min=0;this.max=100;this.showTicks=false;this.ticks=[];this.show=this.showMark=false};f.jqplot.PieLegendRenderer=function(){f.jqplot.TableLegendRenderer.call(this)};f.jqplot.PieLegendRenderer.prototype=new f.jqplot.TableLegendRenderer;f.jqplot.PieLegendRenderer.prototype.constructor=f.jqplot.PieLegendRenderer;f.jqplot.PieLegendRenderer.prototype.init=function(b){this.numberColumns=this.numberRows=null;f.extend(true,this,b)};f.jqplot.PieLegendRenderer.prototype.draw=
function(){if(this.show){var b=this._series;this._elem=f(document.createElement("table"));this._elem.addClass("jqplot-table-legend");var c={position:"absolute"};if(this.background)c.background=this.background;if(this.border)c.border=this.border;if(this.fontSize)c.fontSize=this.fontSize;if(this.fontFamily)c.fontFamily=this.fontFamily;if(this.textColor)c.textColor=this.textColor;if(this.marginTop!=null)c.marginTop=this.marginTop;if(this.marginBottom!=null)c.marginBottom=this.marginBottom;if(this.marginLeft!=
null)c.marginLeft=this.marginLeft;if(this.marginRight!=null)c.marginRight=this.marginRight;this._elem.css(c);var a=false,e;c=b[0];b=new f.jqplot.ColorGenerator(c.seriesColors);if(c.show){var d=c.data;if(this.numberRows){c=this.numberRows;e=this.numberColumns?this.numberColumns:Math.ceil(d.length/c)}else if(this.numberColumns){e=this.numberColumns;c=Math.ceil(d.length/this.numberColumns)}else{c=d.length;e=1}var g,h,m,j,i,q,n=0,l,o;for(g=0;g<c;g++){m=f(document.createElement("tr"));m.addClass("jqplot-table-legend");
m.appendTo(this._elem);for(h=0;h<e;h++){if(n<d.length){i=this.labels[n]||d[n][0].toString();j=b.next();q=(a=g>0?true:false)?this.rowSpacing:"0";a=f(document.createElement("td"));a.addClass("jqplot-table-legend jqplot-table-legend-swatch");a.css({textAlign:"center",paddingTop:q});l=f(document.createElement("div"));l.addClass("jqplot-table-legend-swatch-outline");o=f(document.createElement("div"));o.addClass("jqplot-table-legend-swatch");o.css({backgroundColor:j,borderColor:j});a.append(l.append(o));
j=f(document.createElement("td"));j.addClass("jqplot-table-legend jqplot-table-legend-label");j.css("paddingTop",q);this.escapeHtml?j.text(i):j.html(i);a.appendTo(m);j.appendTo(m)}n++}}}}return this._elem};f.jqplot.PieRenderer.prototype.handleMove=function(b,c,a,e,d){if(e){b=[e.seriesIndex,e.pointIndex,e.data];d.target.trigger("jqplotDataMouseOver",b);if(d.series[b[0]].highlightMouseOver&&!(b[0]==d.plugins.pieRenderer.highlightedSeriesIndex&&b[1]==d.series[b[0]]._highlightedPoint)){d.target.trigger("jqplotDataHighlight",
b);u(d,b[0],b[1])}}else e==null&&r(d)};f.jqplot.preInitHooks.push(function(b,c,a){a=a||{};a.axesDefaults=a.axesDefaults||{};a.legend=a.legend||{};a.seriesDefaults=a.seriesDefaults||{};b=false;if(a.seriesDefaults.renderer==f.jqplot.PieRenderer)b=true;else if(a.series)for(c=0;c<a.series.length;c++)if(a.series[c].renderer==f.jqplot.PieRenderer)b=true;if(b){a.axesDefaults.renderer=f.jqplot.PieAxisRenderer;a.legend.renderer=f.jqplot.PieLegendRenderer;a.legend.preDraw=true;a.seriesDefaults.pointLabels=
{show:false}}});f.jqplot.PieTickRenderer=function(){f.jqplot.AxisTickRenderer.call(this)};f.jqplot.PieTickRenderer.prototype=new f.jqplot.AxisTickRenderer;f.jqplot.PieTickRenderer.prototype.constructor=f.jqplot.PieTickRenderer})(jQuery);
