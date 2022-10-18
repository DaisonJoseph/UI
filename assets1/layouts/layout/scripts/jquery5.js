!function(t){"object"==typeof module&&module.exports?module.exports=t:t(Highcharts)}(function(t){!function(t){function i(t,i){this.init(t,i)}var a=t.CenteredSeriesMixin,e=t.each,o=t.extend,s=t.merge,r=t.splat;o(i.prototype,{coll:"pane",init:function(t,i){this.chart=i,this.background=[],i.pane.push(this),this.setOptions(t)},setOptions:function(t){this.options=s(this.defaultOptions,this.chart.angular?{background:{}}:void 0,t)},render:function(){var t=this.options,i=this.options.background,a=this.chart.renderer;if(this.group||(this.group=a.g("pane-group").attr({zIndex:t.zIndex||0}).add()),this.updateCenter(),i)for(i=r(i),t=Math.max(i.length,this.background.length||0),a=0;t>a;a++)i[a]&&this.axis?this.renderBackground(s(this.defaultBackgroundOptions,i[a]),a):this.background[a]&&(this.background[a]=this.background[a].destroy(),this.background.splice(a,1))},renderBackground:function(t,i){var a="animate";this.background[i]||(this.background[i]=this.chart.renderer.path().add(this.group),a="attr"),this.background[i][a]({d:this.axis.getPlotBandPath(t.from,t.to,t)}).attr({fill:t.backgroundColor,stroke:t.borderColor,"stroke-width":t.borderWidth,"class":"highcharts-pane "+(t.className||"")})},defaultOptions:{center:["50%","50%"],size:"85%",startAngle:0},defaultBackgroundOptions:{shape:"circle",borderWidth:1,borderColor:"#cccccc",backgroundColor:{linearGradient:{x1:0,y1:0,x2:0,y2:1},stops:[[0,"#ffffff"],[1,"#e6e6e6"]]},from:-Number.MAX_VALUE,innerRadius:0,to:Number.MAX_VALUE,outerRadius:"105%"},updateCenter:function(t){this.center=(t||this.axis||{}).center=a.getCenter.call(this)},update:function(t,i){s(!0,this.options,t),this.setOptions(this.options),this.render(),e(this.chart.axes,function(t){t.pane===this&&(t.pane=null,t.update({},i))},this)}}),t.Pane=i}(t),function(t){var i,a,e=t.each,o=t.extend,s=t.map,r=t.merge,n=t.noop,h=t.pick,l=t.pInt,p=t.wrap,c=t.Axis.prototype;t=t.Tick.prototype,i={getOffset:n,redraw:function(){this.isDirty=!1},render:function(){this.isDirty=!1},setScale:n,setCategories:n,setTitle:n},a={defaultRadialGaugeOptions:{labels:{align:"center",x:0,y:null},minorGridLineWidth:0,minorTickInterval:"auto",minorTickLength:10,minorTickPosition:"inside",minorTickWidth:1,tickLength:10,tickPosition:"inside",tickWidth:2,title:{rotation:0},zIndex:2},defaultRadialXOptions:{gridLineWidth:1,labels:{align:null,distance:15,x:0,y:null},maxPadding:0,minPadding:0,showLastLabel:!1,tickLength:0},defaultRadialYOptions:{gridLineInterpolation:"circle",labels:{align:"right",x:-3,y:-2},showLastLabel:!1,title:{x:4,text:null,rotation:90}},setOptions:function(t){t=this.options=r(this.defaultOptions,this.defaultRadialOptions,t),t.plotBands||(t.plotBands=[])},getOffset:function(){c.getOffset.call(this),this.chart.axisOffset[this.side]=0},getLinePath:function(t,i){t=this.center;var a=this.chart,e=h(i,t[2]/2-this.offset);return this.isCircular||void 0!==i?i=this.chart.renderer.symbols.arc(this.left+t[0],this.top+t[1],e,e,{start:this.startAngleRad,end:this.endAngleRad,open:!0,innerR:0}):(i=this.postTranslate(this.angleRad,e),i=["M",t[0]+a.plotLeft,t[1]+a.plotTop,"L",i.x,i.y]),i},setAxisTranslation:function(){c.setAxisTranslation.call(this),this.center&&(this.transA=this.isCircular?(this.endAngleRad-this.startAngleRad)/(this.max-this.min||1):this.center[2]/2/(this.max-this.min||1),this.minPixelPadding=this.isXAxis?this.transA*this.minPointOffset:0)},beforeSetTickPositions:function(){(this.autoConnect=this.isCircular&&void 0===h(this.userMax,this.options.max)&&this.endAngleRad-this.startAngleRad===2*Math.PI)&&(this.max+=this.categories&&1||this.pointRange||this.closestPointRange||0)},setAxisSize:function(){c.setAxisSize.call(this),this.isRadial&&(this.pane.updateCenter(this),this.isCircular&&(this.sector=this.endAngleRad-this.startAngleRad),this.len=this.width=this.height=this.center[2]*h(this.sector,1)/2)},getPosition:function(t,i){return this.postTranslate(this.isCircular?this.translate(t):this.angleRad,h(this.isCircular?i:this.translate(t),this.center[2]/2)-this.offset)},postTranslate:function(t,i){var a=this.chart,e=this.center;return t=this.startAngleRad+t,{x:a.plotLeft+e[0]+Math.cos(t)*i,y:a.plotTop+e[1]+Math.sin(t)*i}},getPlotBandPath:function(t,i,a){var e,o=this.center,r=this.startAngleRad,n=o[2]/2,p=[h(a.outerRadius,"100%"),a.innerRadius,h(a.thickness,10)],c=Math.min(this.offset,0),d=/%$/,u=this.isCircular;return"polygon"===this.options.gridLineInterpolation?o=this.getPlotLinePath(t).concat(this.getPlotLinePath(i,!0)):(t=Math.max(t,this.min),i=Math.min(i,this.max),u||(p[0]=this.translate(t),p[1]=this.translate(i)),p=s(p,function(t){return d.test(t)&&(t=l(t,10)*n/100),t}),"circle"!==a.shape&&u?(t=r+this.translate(t),i=r+this.translate(i)):(t=-Math.PI/2,i=1.5*Math.PI,e=!0),p[0]-=c,p[2]-=c,o=this.chart.renderer.symbols.arc(this.left+o[0],this.top+o[1],p[0],p[0],{start:Math.min(t,i),end:Math.max(t,i),innerR:h(p[1],p[0]-p[2]),open:e})),o},getPlotLinePath:function(t,i){var a,o,s,r=this,n=r.center,h=r.chart,l=r.getPosition(t);return r.isCircular?s=["M",n[0]+h.plotLeft,n[1]+h.plotTop,"L",l.x,l.y]:"circle"===r.options.gridLineInterpolation?(t=r.translate(t))&&(s=r.getLinePath(0,t)):(e(h.xAxis,function(t){t.pane===r.pane&&(a=t)}),s=[],t=r.translate(t),n=a.tickPositions,a.autoConnect&&(n=n.concat([n[0]])),i&&(n=[].concat(n).reverse()),e(n,function(i,e){o=a.getPosition(i,t),s.push(e?"L":"M",o.x,o.y)})),s},getTitlePosition:function(){var t=this.center,i=this.chart,a=this.options.title;return{x:i.plotLeft+t[0]+(a.x||0),y:i.plotTop+t[1]-{high:.5,middle:.25,low:0}[a.align]*t[2]+(a.y||0)}}},p(c,"init",function(t,e,s){var n,l=e.angular,p=e.polar,c=s.isX,d=l&&c,u=e.options,g=this.pane=e.pane[s.pane||0],f=g.options;l?(o(this,d?i:a),(n=!c)&&(this.defaultRadialOptions=this.defaultRadialGaugeOptions)):p&&(o(this,a),this.defaultRadialOptions=(n=c)?this.defaultRadialXOptions:r(this.defaultYAxisOptions,this.defaultRadialYOptions)),l||p?(this.isRadial=!0,e.inverted=!1,u.chart.zoomType=null):this.isRadial=!1,n&&(g.axis=this),t.call(this,e,s),d||!l&&!p||(t=this.options,this.angleRad=(t.angle||0)*Math.PI/180,this.startAngleRad=(f.startAngle-90)*Math.PI/180,this.endAngleRad=(h(f.endAngle,f.startAngle+360)-90)*Math.PI/180,this.offset=t.offset||0,this.isCircular=n)}),p(c,"autoLabelAlign",function(t){return this.isRadial?void 0:t.apply(this,[].slice.call(arguments,1))}),p(t,"getPosition",function(t,i,a,e,o){var s=this.axis;return s.getPosition?s.getPosition(a):t.call(this,i,a,e,o)}),p(t,"getLabelPosition",function(t,i,a,e,o,s,r,n,l){var p=this.axis,c=s.y,d=20,u=s.align,g=(p.translate(this.pos)+p.startAngleRad+Math.PI/2)/Math.PI*180%360;return p.isRadial?(t=p.getPosition(this.pos,p.center[2]/2+h(s.distance,-25)),"auto"===s.rotation?e.attr({rotation:g}):null===c&&(c=p.chart.renderer.fontMetrics(e.styles.fontSize).b-e.getBBox().height/2),null===u&&(p.isCircular?(this.label.getBBox().width>p.len*p.tickInterval/(p.max-p.min)&&(d=0),u=g>d&&180-d>g?"left":g>180+d&&360-d>g?"right":"center"):u="center",e.attr({align:u})),t.x+=s.x,t.y+=c):t=t.call(this,i,a,e,o,s,r,n,l),t}),p(t,"getMarkPath",function(t,i,a,e,o,s,r){var n=this.axis;return n.isRadial?(t=n.getPosition(this.pos,n.center[2]/2+e),i=["M",i,a,"L",t.x,t.y]):i=t.call(this,i,a,e,o,s,r),i})}(t),function(t){var i=t.each,a=t.pick,e=t.defined,o=t.seriesType,s=t.seriesTypes,r=t.Series.prototype,n=t.Point.prototype;o("arearange","area",{lineWidth:1,threshold:null,tooltip:{pointFormat:'<span style="color:{series.color}">●</span> {series.name}: <b>{point.low}</b> - <b>{point.high}</b><br/>'},trackByArea:!0,dataLabels:{align:null,verticalAlign:null,xLow:0,xHigh:0,yLow:0,yHigh:0}},{pointArrayMap:["low","high"],dataLabelCollections:["dataLabel","dataLabelUpper"],toYData:function(t){return[t.low,t.high]},pointValKey:"low",deferTranslatePolar:!0,highToXY:function(t){var i=this.chart,a=this.xAxis.postTranslate(t.rectPlotX,this.yAxis.len-t.plotHigh);t.plotHighX=a.x-i.plotLeft,t.plotHigh=a.y-i.plotTop,t.plotLowX=t.plotX},translate:function(){var t=this,a=t.yAxis,e=!!t.modifyValue;s.area.prototype.translate.apply(t),i(t.points,function(i){var o=i.low,s=i.high,r=i.plotY;null===s||null===o?(i.isNull=!0,i.plotY=null):(i.plotLow=r,i.plotHigh=a.translate(e?t.modifyValue(s,i):s,0,1,0,1),e&&(i.yBottom=i.plotHigh))}),this.chart.polar&&i(this.points,function(i){t.highToXY(i),i.tooltipPos=[(i.plotHighX+i.plotLowX)/2,(i.plotHigh+i.plotLow)/2]})},getGraphPath:function(t){var i,e,o,r,n=[],h=[],l=s.area.prototype.getGraphPath;r=this.options;var p=this.chart.polar&&!1!==r.connectEnds,c=r.connectNulls,d=r.step;for(t=t||this.points,i=t.length;i--;)e=t[i],e.isNull||p||c||t[i+1]&&!t[i+1].isNull||h.push({plotX:e.plotX,plotY:e.plotY,doCurve:!1}),o={polarPlotY:e.polarPlotY,rectPlotX:e.rectPlotX,yBottom:e.yBottom,plotX:a(e.plotHighX,e.plotX),plotY:e.plotHigh,isNull:e.isNull},h.push(o),n.push(o),e.isNull||p||c||t[i-1]&&!t[i-1].isNull||h.push({plotX:e.plotX,plotY:e.plotY,doCurve:!1});return t=l.call(this,t),d&&(!0===d&&(d="left"),r.step={left:"right",center:"center",right:"left"}[d]),n=l.call(this,n),h=l.call(this,h),r.step=d,r=[].concat(t,n),this.chart.polar||"M"!==h[0]||(h[0]="L"),this.graphPath=r,this.areaPath=this.areaPath.concat(t,h),r.isArea=!0,r.xMap=t.xMap,this.areaPath.xMap=t.xMap,r},drawDataLabels:function(){var t,i,a,e=this.data,o=e.length,s=[],n=this.options.dataLabels,h=n.align,l=n.verticalAlign,p=n.inside,c=this.chart.inverted;if(n.enabled||this._hasPointLabels){for(t=o;t--;)(i=e[t])&&(a=p?i.plotHigh<i.plotLow:i.plotHigh>i.plotLow,i.y=i.high,i._plotY=i.plotY,i.plotY=i.plotHigh,s[t]=i.dataLabel,i.dataLabel=i.dataLabelUpper,i.below=a,c?h||(n.align=a?"right":"left"):l||(n.verticalAlign=a?"top":"bottom"),n.x=n.xHigh,n.y=n.yHigh);for(r.drawDataLabels&&r.drawDataLabels.apply(this,arguments),t=o;t--;)(i=e[t])&&(a=p?i.plotHigh<i.plotLow:i.plotHigh>i.plotLow,i.dataLabelUpper=i.dataLabel,i.dataLabel=s[t],i.y=i.low,i.plotY=i._plotY,i.below=!a,c?h||(n.align=a?"left":"right"):l||(n.verticalAlign=a?"bottom":"top"),n.x=n.xLow,n.y=n.yLow);r.drawDataLabels&&r.drawDataLabels.apply(this,arguments)}n.align=h,n.verticalAlign=l},alignDataLabel:function(){s.column.prototype.alignDataLabel.apply(this,arguments)},drawPoints:function(){var t,i,a=this.points.length;for(r.drawPoints.apply(this,arguments),i=0;a>i;)t=this.points[i],t.lowerGraphic=t.graphic,t.graphic=t.upperGraphic,t._plotY=t.plotY,t._plotX=t.plotX,t.plotY=t.plotHigh,e(t.plotHighX)&&(t.plotX=t.plotHighX),i++;for(r.drawPoints.apply(this,arguments),i=0;a>i;)t=this.points[i],t.upperGraphic=t.graphic,t.graphic=t.lowerGraphic,t.plotY=t._plotY,t.plotX=t._plotX,i++},setStackedPoints:t.noop},{setState:function(){var t=this.state,i=this.series,a=i.chart.polar;e(this.plotHigh)||(this.plotHigh=i.yAxis.toPixels(this.high,!0)),e(this.plotLow)||(this.plotLow=this.plotY=i.yAxis.toPixels(this.low,!0)),n.setState.apply(this,arguments),this.graphic=this.upperGraphic,this.plotY=this.plotHigh,a&&(this.plotX=this.plotHighX),this.state=t,i.stateMarkerGraphic&&(i.lowerStateMarkerGraphic=i.stateMarkerGraphic,i.stateMarkerGraphic=i.upperStateMarkerGraphic),n.setState.apply(this,arguments),this.plotY=this.plotLow,this.graphic=this.lowerGraphic,a&&(this.plotX=this.plotLowX),i.stateMarkerGraphic&&(i.upperStateMarkerGraphic=i.stateMarkerGraphic,i.stateMarkerGraphic=i.lowerStateMarkerGraphic)},haloPath:function(){var t,i=this.series.chart.polar;return this.plotY=this.plotLow,i&&(this.plotX=this.plotLowX),t=n.haloPath.apply(this,arguments),this.plotY=this.plotHigh,i&&(this.plotX=this.plotHighX),t=t.concat(n.haloPath.apply(this,arguments))},destroy:function(){return this.upperGraphic&&(this.upperGraphic=this.upperGraphic.destroy()),n.destroy.apply(this,arguments)}})}(t),function(t){var i=t.seriesType;i("areasplinerange","arearange",null,{getPointSpline:t.seriesTypes.spline.prototype.getPointSpline})}(t),function(t){var i=t.defaultPlotOptions,a=t.each,e=t.merge,o=t.noop,s=t.pick,r=t.seriesType,n=t.seriesTypes.column.prototype;r("columnrange","arearange",e(i.column,i.arearange,{lineWidth:1,pointRange:null,marker:null,states:{hover:{halo:!1}}}),{translate:function(){var t,i,e=this,o=e.yAxis,r=e.xAxis,h=r.startAngleRad,l=e.chart,p=e.xAxis.isRadial,c=Math.max(l.chartWidth,l.chartHeight)+999;n.translate.apply(e),a(e.points,function(a){var n,d,u=a.shapeArgs,g=e.options.minPointLength;a.plotHigh=i=Math.min(Math.max(-c,o.translate(a.high,0,1,0,1)),c),a.plotLow=Math.min(Math.max(-c,a.plotY),c),d=i,n=s(a.rectPlotY,a.plotY)-i,Math.abs(n)<g?(g-=n,n+=g,d-=g/2):0>n&&(n*=-1,d-=n),p?(t=a.barX+h,a.shapeType="path",a.shapeArgs={d:e.polarArc(d+n,d,t,t+a.pointWidth)}):(u.height=n,u.y=d,a.tooltipPos=l.inverted?[o.len+o.pos-l.plotLeft-d-n/2,r.len+r.pos-l.plotTop-u.x-u.width/2,n]:[r.left-l.plotLeft+u.x+u.width/2,o.pos-l.plotTop+d+n/2,n])})},directTouch:!0,trackerGroups:["group","dataLabelsGroup"],drawGraph:o,getSymbol:o,crispCol:n.crispCol,drawPoints:n.drawPoints,drawTracker:n.drawTracker,getColumnMetrics:n.getColumnMetrics,animate:function(){return n.animate.apply(this,arguments)},polarArc:function(){return n.polarArc.apply(this,arguments)},pointAttribs:n.pointAttribs},{setState:n.pointClass.prototype.setState})}(t),function(t){var i=t.each,a=t.isNumber,e=t.merge,o=t.pick,s=t.pInt,r=t.Series,n=t.seriesType,h=t.TrackerMixin;n("gauge","line",{dataLabels:{enabled:!0,defer:!1,y:15,borderRadius:3,crop:!1,verticalAlign:"top",zIndex:2,borderWidth:1,borderColor:"#cccccc"},dial:{},pivot:{},tooltip:{headerFormat:""},showInLegend:!1},{angular:!0,directTouch:!0,drawGraph:t.noop,fixedBox:!0,forceDL:!0,noSharedTooltip:!0,trackerGroups:["group","dataLabelsGroup"],translate:function(){var t=this.yAxis,r=this.options,n=t.center;this.generatePoints(),i(this.points,function(i){var h=e(r.dial,i.dial),l=s(o(h.radius,80))*n[2]/200,p=s(o(h.baseLength,70))*l/100,c=s(o(h.rearLength,10))*l/100,d=h.baseWidth||3,u=h.topWidth||1,g=r.overshoot,f=t.startAngleRad+t.translate(i.y,null,null,null,!0);a(g)?(g=g/180*Math.PI,f=Math.max(t.startAngleRad-g,Math.min(t.endAngleRad+g,f))):!1===r.wrap&&(f=Math.max(t.startAngleRad,Math.min(t.endAngleRad,f))),f=180*f/Math.PI,i.shapeType="path",i.shapeArgs={d:h.path||["M",-c,-d/2,"L",p,-d/2,l,-u/2,l,u/2,p,d/2,-c,d/2,"z"],translateX:n[0],translateY:n[1],rotation:f},i.plotX=n[0],i.plotY=n[1]})},drawPoints:function(){var t=this,a=t.yAxis.center,s=t.pivot,r=t.options,n=r.pivot,h=t.chart.renderer;i(t.points,function(i){var a=i.graphic,o=i.shapeArgs,s=o.d,n=e(r.dial,i.dial);a?(a.animate(o),o.d=s):(i.graphic=h[i.shapeType](o).attr({rotation:o.rotation,zIndex:1}).addClass("highcharts-dial").add(t.group),i.graphic.attr({stroke:n.borderColor||"none","stroke-width":n.borderWidth||0,fill:n.backgroundColor||"#000000"}))}),s?s.animate({translateX:a[0],translateY:a[1]}):(t.pivot=h.circle(0,0,o(n.radius,5)).attr({zIndex:2}).addClass("highcharts-pivot").translate(a[0],a[1]).add(t.group),t.pivot.attr({"stroke-width":n.borderWidth||0,stroke:n.borderColor||"#cccccc",fill:n.backgroundColor||"#000000"}))},animate:function(t){var a=this;t||(i(a.points,function(t){var i=t.graphic;i&&(i.attr({rotation:180*a.yAxis.startAngleRad/Math.PI}),i.animate({rotation:t.shapeArgs.rotation},a.options.animation))}),a.animate=null)},render:function(){this.group=this.plotGroup("group","series",this.visible?"visible":"hidden",this.options.zIndex,this.chart.seriesGroup),r.prototype.render.call(this),this.group.clip(this.chart.clipRect)},setData:function(t,i){r.prototype.setData.call(this,t,!1),this.processData(),this.generatePoints(),o(i,!0)&&this.chart.redraw()},drawTracker:h&&h.drawTrackerPoint},{setState:function(t){this.state=t}})}(t),function(t){var i=t.each,a=t.noop,e=t.pick,o=t.seriesType,s=t.seriesTypes;o("boxplot","column",{threshold:null,tooltip:{pointFormat:'<span style="color:{point.color}">●</span> <b> {series.name}</b><br/>Maximum: {point.high}<br/>Upper quartile: {point.q3}<br/>Median: {point.median}<br/>Lower quartile: {point.q1}<br/>Minimum: {point.low}<br/>'},whiskerLength:"50%",fillColor:"#ffffff",lineWidth:1,medianWidth:2,states:{hover:{brightness:-.3}},whiskerWidth:2},{pointArrayMap:["low","q1","median","q3","high"],toYData:function(t){return[t.low,t.q1,t.median,t.q3,t.high]},pointValKey:"high",pointAttribs:function(t){var i=this.options,a=t&&t.color||this.color;return{fill:t.fillColor||i.fillColor||a,stroke:i.lineColor||a,"stroke-width":i.lineWidth||0}},drawDataLabels:a,translate:function(){var t=this.yAxis,a=this.pointArrayMap;s.column.prototype.translate.apply(this),i(this.points,function(e){i(a,function(i){null!==e[i]&&(e[i+"Plot"]=t.translate(e[i],0,1,0,1))})})},drawPoints:function(){var t,a,o,s,r,n,h,l,p,c,d,u=this,g=u.options,f=u.chart.renderer,m=0,y=!1!==u.doQuartiles,x=u.options.whiskerLength;i(u.points,function(i){var b=i.graphic,P=b?"animate":"attr",M=i.shapeArgs,k={},v={},w={},A=i.color||u.color;void 0!==i.plotY&&(h=M.width,l=Math.floor(M.x),p=l+h,c=Math.round(h/2),t=Math.floor(y?i.q1Plot:i.lowPlot),a=Math.floor(y?i.q3Plot:i.lowPlot),o=Math.floor(i.highPlot),s=Math.floor(i.lowPlot),b||(i.graphic=b=f.g("point").add(u.group),i.stem=f.path().addClass("highcharts-boxplot-stem").add(b),x&&(i.whiskers=f.path().addClass("highcharts-boxplot-whisker").add(b)),y&&(i.box=f.path(void 0).addClass("highcharts-boxplot-box").add(b)),i.medianShape=f.path(void 0).addClass("highcharts-boxplot-median").add(b)),k.stroke=i.stemColor||g.stemColor||A,k["stroke-width"]=e(i.stemWidth,g.stemWidth,g.lineWidth),k.dashstyle=i.stemDashStyle||g.stemDashStyle,i.stem.attr(k),x&&(v.stroke=i.whiskerColor||g.whiskerColor||A,v["stroke-width"]=e(i.whiskerWidth,g.whiskerWidth,g.lineWidth),i.whiskers.attr(v)),y&&(b=u.pointAttribs(i),i.box.attr(b)),w.stroke=i.medianColor||g.medianColor||A,w["stroke-width"]=e(i.medianWidth,g.medianWidth,g.lineWidth),i.medianShape.attr(w),n=i.stem.strokeWidth()%2/2,m=l+c+n,i.stem[P]({d:["M",m,a,"L",m,o,"M",m,t,"L",m,s]}),y&&(n=i.box.strokeWidth()%2/2,t=Math.floor(t)+n,a=Math.floor(a)+n,l+=n,p+=n,i.box[P]({d:["M",l,a,"L",l,t,"L",p,t,"L",p,a,"L",l,a,"z"]})),x&&(n=i.whiskers.strokeWidth()%2/2,o+=n,s+=n,d=/%$/.test(x)?c*parseFloat(x)/100:x/2,i.whiskers[P]({d:["M",m-d,o,"L",m+d,o,"M",m-d,s,"L",m+d,s]})),r=Math.round(i.medianPlot),n=i.medianShape.strokeWidth()%2/2,r+=n,i.medianShape[P]({d:["M",l,r,"L",p,r]}))})},setStackedPoints:a})}(t),function(t){var i=t.each,a=t.noop,e=t.seriesType,o=t.seriesTypes;e("errorbar","boxplot",{color:"#000000",grouping:!1,linkedTo:":previous",tooltip:{pointFormat:'<span style="color:{point.color}">●</span> {series.name}: <b>{point.low}</b> - <b>{point.high}</b><br/>'},whiskerWidth:null},{type:"errorbar",pointArrayMap:["low","high"],toYData:function(t){return[t.low,t.high]},pointValKey:"high",doQuartiles:!1,drawDataLabels:o.arearange?function(){var t=this.pointValKey;o.arearange.prototype.drawDataLabels.call(this),i(this.data,function(i){i.y=i[t]})}:a,getColumnMetrics:function(){return this.linkedParent&&this.linkedParent.columnMetrics||o.column.prototype.getColumnMetrics.call(this)}})}(t),function(t){var i=t.correctFloat,a=t.isNumber,e=t.pick,o=t.Point,s=t.Series,r=t.seriesType,n=t.seriesTypes;r("waterfall","column",{dataLabels:{inside:!0},lineWidth:1,lineColor:"#333333",dashStyle:"dot",borderColor:"#333333",states:{hover:{lineWidthPlus:0}}},{pointValKey:"y",translate:function(){var t,a,o,s,r,h,l,p,c,d,u,g=this.options,f=this.yAxis,m=e(g.minPointLength,5),y=m/2,x=g.threshold,b=g.stacking;for(n.column.prototype.translate.apply(this),p=c=x,a=this.points,t=0,g=a.length;g>t;t++)o=a[t],l=this.processedYData[t],s=o.shapeArgs,r=b&&f.stacks[(this.negStacks&&x>l?"-":"")+this.stackKey],u=this.getStackIndicator(u,o.x,this.index),d=r?r[o.x].points[u.key]:[0,l],o.isSum?o.y=i(l):o.isIntermediateSum&&(o.y=i(l-c)),h=Math.max(p,p+o.y)+d[0],s.y=f.translate(h,0,1,0,1),o.isSum?(s.y=f.translate(d[1],0,1,0,1),s.height=Math.min(f.translate(d[0],0,1,0,1),f.len)-s.y):o.isIntermediateSum?(s.y=f.translate(d[1],0,1,0,1),s.height=Math.min(f.translate(c,0,1,0,1),f.len)-s.y,c=d[1]):(s.height=l>0?f.translate(p,0,1,0,1)-s.y:f.translate(p,0,1,0,1)-f.translate(p-l,0,1,0,1),p+=r&&r[o.x]?r[o.x].total:l),0>s.height&&(s.y+=s.height,s.height*=-1),o.plotY=s.y=Math.round(s.y)-this.borderWidth%2/2,s.height=Math.max(Math.round(s.height),.001),o.yBottom=s.y+s.height,s.height<=m&&!o.isNull?(s.height=m,s.y-=y,o.plotY=s.y,o.minPointLengthOffset=0>o.y?-y:y):o.minPointLengthOffset=0,s=o.plotY+(o.negative?s.height:0),this.chart.inverted?o.tooltipPos[0]=f.len-s:o.tooltipPos[1]=s},processData:function(t){var a,e,o,r,n,h,l,p=this.yData,c=this.options.data,d=p.length;for(o=e=r=n=this.options.threshold||0,l=0;d>l;l++)h=p[l],a=c&&c[l]?c[l]:{},"sum"===h||a.isSum?p[l]=i(o):"intermediateSum"===h||a.isIntermediateSum?p[l]=i(e):(o+=h,e+=h),r=Math.min(o,r),n=Math.max(o,n);s.prototype.processData.call(this,t),this.options.stacking||(this.dataMin=r,this.dataMax=n)},toYData:function(t){return t.isSum?0===t.x?null:"sum":t.isIntermediateSum?0===t.x?null:"intermediateSum":t.y},pointAttribs:function(t,i){var a=this.options.upColor;return a&&!t.options.color&&(t.color=0<t.y?a:null),t=n.column.prototype.pointAttribs.call(this,t,i),delete t.dashstyle,t},getGraphPath:function(){return["M",0,0]},getCrispPath:function(){var t,i,a,e=this.data,o=e.length,s=this.graph.strokeWidth()+this.borderWidth,s=Math.round(s)%2/2,r=this.yAxis.reversed,n=[];for(a=1;o>a;a++)i=e[a].shapeArgs,t=e[a-1].shapeArgs,i=["M",t.x+t.width,t.y+e[a-1].minPointLengthOffset+s,"L",i.x,t.y+e[a-1].minPointLengthOffset+s],(0>e[a-1].y&&!r||0<e[a-1].y&&r)&&(i[2]+=t.height,i[5]+=t.height),n=n.concat(i);return n},drawGraph:function(){s.prototype.drawGraph.call(this),this.graph.attr({d:this.getCrispPath()})},setStackedPoints:function(){var t,i,a=this.options;for(s.prototype.setStackedPoints.apply(this,arguments),t=this.stackedYData?this.stackedYData.length:0,i=1;t>i;i++)a.data[i].isSum||a.data[i].isIntermediateSum||(this.stackedYData[i]+=this.stackedYData[i-1])},getExtremes:function(){return this.options.stacking?s.prototype.getExtremes.apply(this,arguments):void 0}},{getClassName:function(){var t=o.prototype.getClassName.call(this);return this.isSum?t+=" highcharts-sum":this.isIntermediateSum&&(t+=" highcharts-intermediate-sum"),t},isValid:function(){return a(this.y,!0)||this.isSum||this.isIntermediateSum}})}(t),function(t){var i=t.Series,a=t.seriesType,e=t.seriesTypes;a("polygon","scatter",{marker:{enabled:!1,states:{hover:{enabled:!1}}},stickyTracking:!1,tooltip:{followPointer:!0,pointFormat:""},trackByArea:!0},{type:"polygon",getGraphPath:function(){for(var t=i.prototype.getGraphPath.call(this),a=t.length+1;a--;)(a===t.length||"M"===t[a])&&a>0&&t.splice(a,0,"z");return this.areaPath=t},drawGraph:function(){this.options.fillColor=this.color,e.area.prototype.drawGraph.call(this)},drawLegendSymbol:t.LegendSymbolMixin.drawRectangle,drawTracker:i.prototype.drawTracker,setStackedPoints:t.noop})}(t),function(t){var i=t.arrayMax,a=t.arrayMin,e=t.Axis,o=t.color,s=t.each,r=t.isNumber,n=t.noop,h=t.pick,l=t.pInt,p=t.Point,c=t.Series,d=t.seriesType,u=t.seriesTypes;d("bubble","scatter",{dataLabels:{formatter:function(){return this.point.z},inside:!0,verticalAlign:"middle"},marker:{lineColor:null,lineWidth:1,radius:null,states:{hover:{radiusPlus:0}},symbol:"circle"},minSize:8,maxSize:"20%",softThreshold:!1,states:{hover:{halo:{size:5}}},tooltip:{pointFormat:"({point.x}, {point.y}), Size: {point.z}"},turboThreshold:0,zThreshold:0,zoneAxis:"z"},{pointArrayMap:["y","z"],parallelArrays:["x","y","z"],trackerGroups:["group","dataLabelsGroup"],specialGroup:"group",bubblePadding:!0,zoneAxis:"z",directTouch:!0,pointAttribs:function(t,i){var a=h(this.options.marker.fillOpacity,.5);return t=c.prototype.pointAttribs.call(this,t,i),1!==a&&(t.fill=o(t.fill).setOpacity(a).get("rgba")),t},getRadii:function(t,i,a,e){var o,s,r,n=this.zData,h=[],l=this.options,p="width"!==l.sizeBy,c=l.zThreshold,d=i-t;for(s=0,o=n.length;o>s;s++)r=n[s],l.sizeByAbsoluteValue&&null!==r&&(r=Math.abs(r-c),i=Math.max(i-c,Math.abs(t-c)),t=0),null===r?r=null:t>r?r=a/2-1:(r=d>0?(r-t)/d:.5,p&&r>=0&&(r=Math.sqrt(r)),r=Math.ceil(a+r*(e-a))/2),h.push(r);this.radii=h},animate:function(t){var i=this.options.animation;t||(s(this.points,function(t){var a,e=t.graphic;e&&e.width&&(a={x:e.x,y:e.y,width:e.width,height:e.height},e.attr({x:t.plotX,y:t.plotY,width:1,height:1}),e.animate(a,i))}),this.animate=null)},translate:function(){var i,a,e,o=this.data,s=this.radii;for(u.scatter.prototype.translate.call(this),i=o.length;i--;)a=o[i],e=s?s[i]:0,r(e)&&e>=this.minPxSize/2?(a.marker=t.extend(a.marker,{radius:e,width:2*e,height:2*e}),a.dlBox={x:a.plotX-e,y:a.plotY-e,width:2*e,height:2*e}):a.shapeArgs=a.plotY=a.dlBox=void 0},alignDataLabel:u.column.prototype.alignDataLabel,buildKDTree:n,applyZones:n},{haloPath:function(t){return p.prototype.haloPath.call(this,0===t?0:(this.marker?this.marker.radius||0:0)+t)},ttBelow:!1}),e.prototype.beforePadding=function(){var t=this,e=this.len,o=this.chart,n=0,p=e,c=this.isXAxis,d=c?"xData":"yData",u=this.min,g={},f=Math.min(o.plotWidth,o.plotHeight),m=Number.MAX_VALUE,y=-Number.MAX_VALUE,x=this.max-u,b=e/x,P=[];s(this.series,function(e){var r=e.options;!e.bubblePadding||!e.visible&&o.options.chart.ignoreHiddenSeries||(t.allowZoomOutside=!0,P.push(e),c&&(s(["minSize","maxSize"],function(t){var i=r[t],a=/%$/.test(i),i=l(i);g[t]=a?f*i/100:i}),e.minPxSize=g.minSize,e.maxPxSize=Math.max(g.maxSize,g.minSize),e=e.zData,e.length&&(m=h(r.zMin,Math.min(m,Math.max(a(e),!1===r.displayNegative?r.zThreshold:-Number.MAX_VALUE))),y=h(r.zMax,Math.max(y,i(e))))))}),s(P,function(i){var a,e=i[d],o=e.length;if(c&&i.getRadii(m,y,i.minPxSize,i.maxPxSize),x>0)for(;o--;)r(e[o])&&t.dataMin<=e[o]&&e[o]<=t.dataMax&&(a=i.radii[o],n=Math.min((e[o]-u)*b-a,n),p=Math.max((e[o]-u)*b+a,p))}),P.length&&x>0&&!this.isLog&&(p-=e,b*=(e+n-p)/e,s([["min","userMin",n],["max","userMax",p]],function(i){void 0===h(t.options[i[0]],t[i[1]])&&(t[i[0]]+=i[2]/b)}))}}(t),function(t){function i(t,i){var a=this.chart,e=this.options.animation,o=this.group,s=this.markerGroup,r=this.xAxis.center,n=a.plotLeft,h=a.plotTop;a.polar?a.renderer.isSVG&&(!0===e&&(e={}),i?(t={translateX:r[0]+n,translateY:r[1]+h,scaleX:.001,scaleY:.001},o.attr(t),s&&s.attr(t)):(t={translateX:n,translateY:h,scaleX:1,scaleY:1},o.animate(t,e),s&&s.animate(t,e),this.animate=null)):t.call(this,i)}var a=t.each,e=t.pick,o=t.seriesTypes,s=t.wrap,r=t.Series.prototype,n=t.Pointer.prototype;r.searchPointByAngle=function(t){var i=this.chart,a=this.xAxis.pane.center;return this.searchKDTree({clientX:180+-180/Math.PI*Math.atan2(t.chartX-a[0]-i.plotLeft,t.chartY-a[1]-i.plotTop)})},r.getConnectors=function(t,i,a,e){var o,s,r,n,h,l,p,c;return s=e?1:0,o=i>=0&&i<=t.length-1?i:0>i?t.length-1+i:0,i=0>o-1?t.length-(1+s):o-1,s=o+1>t.length-1?s:o+1,r=t[i],s=t[s],n=r.plotX,r=r.plotY,h=s.plotX,l=s.plotY,s=t[o].plotX,o=t[o].plotY,n=(1.5*s+n)/2.5,r=(1.5*o+r)/2.5,h=(1.5*s+h)/2.5,p=(1.5*o+l)/2.5,l=Math.sqrt(Math.pow(n-s,2)+Math.pow(r-o,2)),c=Math.sqrt(Math.pow(h-s,2)+Math.pow(p-o,2)),n=Math.atan2(r-o,n-s),p=Math.PI/2+(n+Math.atan2(p-o,h-s))/2,Math.abs(n-p)>Math.PI/2&&(p-=Math.PI),n=s+Math.cos(p)*l,r=o+Math.sin(p)*l,h=s+Math.cos(Math.PI+p)*c,p=o+Math.sin(Math.PI+p)*c,s={rightContX:h,rightContY:p,leftContX:n,leftContY:r,plotX:s,plotY:o},a&&(s.prevPointCont=this.getConnectors(t,i,!1,e)),s},s(r,"buildKDTree",function(t){this.chart.polar&&(this.kdByAngle?this.searchPoint=this.searchPointByAngle:this.options.findNearestPointBy="xy"),t.apply(this)}),r.toXY=function(t){var i,a=this.chart,e=t.plotX;i=t.plotY,t.rectPlotX=e,t.rectPlotY=i,i=this.xAxis.postTranslate(t.plotX,this.yAxis.len-i),t.plotX=t.polarPlotX=i.x-a.plotLeft,t.plotY=t.polarPlotY=i.y-a.plotTop,this.kdByAngle?(a=(e/Math.PI*180+this.xAxis.pane.options.startAngle)%360,0>a&&(a+=360),t.clientX=a):t.clientX=t.plotX},o.spline&&(s(o.spline.prototype,"getPointSpline",function(t,i,a,e){return this.chart.polar?e?(t=this.getConnectors(i,e,!0,this.connectEnds),t=["C",t.prevPointCont.rightContX,t.prevPointCont.rightContY,t.leftContX,t.leftContY,t.plotX,t.plotY]):t=["M",a.plotX,a.plotY]:t=t.call(this,i,a,e),t}),o.areasplinerange&&(o.areasplinerange.prototype.getPointSpline=o.spline.prototype.getPointSpline)),s(r,"translate",function(t){var i=this.chart;if(t.call(this),i.polar&&(this.kdByAngle=i.tooltip&&i.tooltip.shared,!this.preventPostTranslate))for(t=this.points,i=t.length;i--;)this.toXY(t[i])}),s(r,"getGraphPath",function(t,i){var e,o,s,r=this;if(this.chart.polar){for(i=i||this.points,e=0;e<i.length;e++)if(!i[e].isNull){o=e;break}!1!==this.options.connectEnds&&void 0!==o&&(this.connectEnds=!0,i.splice(i.length,0,i[o]),s=!0),a(i,function(t){void 0===t.polarPlotY&&r.toXY(t)})}return e=t.apply(this,[].slice.call(arguments,1)),s&&i.pop(),e}),s(r,"animate",i),o.column&&(o=o.column.prototype,o.polarArc=function(t,i,a,o){var s=this.xAxis.center,r=this.yAxis.len;return this.chart.renderer.symbols.arc(s[0],s[1],r-i,null,{start:a,end:o,innerR:r-e(t,r)})},s(o,"animate",i),s(o,"translate",function(t){var i,a,e,o=this.xAxis,s=o.startAngleRad;if(this.preventPostTranslate=!0,t.call(this),o.isRadial)for(i=this.points,e=i.length;e--;)a=i[e],t=a.barX+s,a.shapeType="path",a.shapeArgs={d:this.polarArc(a.yBottom,a.plotY,t,t+a.pointWidth)},this.toXY(a),a.tooltipPos=[a.plotX,a.plotY],a.ttBelow=a.plotY>o.center[1]}),s(o,"alignDataLabel",function(t,i,a,e,o,s){this.chart.polar?(t=i.rectPlotX/Math.PI*180,null===e.align&&(e.align=t>20&&160>t?"left":t>200&&340>t?"right":"center"),null===e.verticalAlign&&(e.verticalAlign=45>t||t>315?"bottom":t>135&&225>t?"top":"middle"),r.alignDataLabel.call(this,i,a,e,o,s)):t.call(this,i,a,e,o,s)})),s(n,"getCoordinates",function(t,i){var e=this.chart,o={xAxis:[],yAxis:[]};return e.polar?a(e.axes,function(t){var a=t.isXAxis,s=t.center,r=i.chartX-s[0]-e.plotLeft,s=i.chartY-s[1]-e.plotTop;o[a?"xAxis":"yAxis"].push({axis:t,value:t.translate(a?Math.PI-Math.atan2(r,s):Math.sqrt(Math.pow(r,2)+Math.pow(s,2)),!0)})}):o=t.call(this,i),o}),s(t.Chart.prototype,"getAxes",function(i){this.pane||(this.pane=[]),a(t.splat(this.options.pane),function(i){new t.Pane(i,this)},this),i.call(this)}),s(t.Chart.prototype,"drawChartBox",function(t){t.call(this),a(this.pane,function(t){t.render()})}),s(t.Chart.prototype,"get",function(i,a){return t.find(this.pane,function(t){return t.options.id===a})||i.call(this,a)})}(t)});