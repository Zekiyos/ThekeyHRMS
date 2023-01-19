(function(d){
    var a=/^\s*|\s*$/g,e,c="B".replace(/A(.)|B/,"$1")==="$1";
    var b={
        majorVersion:"3",
        minorVersion:"4.2",
        releaseDate:"2011-04-07",
        _init:function(){
            var s=this,q=document,o=navigator,g=o.userAgent,m,f,l,k,j,r;
            s.isOpera=d.opera&&opera.buildNumber;
            s.isWebKit=/WebKit/.test(g);
            s.isIE=!s.isWebKit&&!s.isOpera&&(/MSIE/gi).test(g)&&(/Explorer/gi).test(o.appName);
            s.isIE6=s.isIE&&/MSIE [56]/.test(g);
            s.isGecko=!s.isWebKit&&/Gecko/.test(g);
            s.isMac=g.indexOf("Mac")!=-1;
            s.isAir=/adobeair/i.test(g);
            s.isIDevice=/(iPad|iPhone)/.test(g);
            if(d.tinyMCEPreInit){
                s.suffix=tinyMCEPreInit.suffix;
                s.baseURL=tinyMCEPreInit.base;
                s.query=tinyMCEPreInit.query;
                return
            }
            s.suffix="";
            f=q.getElementsByTagName("base");
            for(m=0;m<f.length;m++){
                if(r=f[m].href){
                    if(/^https?:\/\/[^\/]+$/.test(r)){
                        r+="/"
                    }
                    k=r?r.match(/.*\//)[0]:""
                }
            }
            function h(i){
                if(i.src&&/tiny_mce(|_gzip|_jquery|_prototype|_full)(_dev|_src)?.js/.test(i.src)){
                    if(/_(src|dev)\.js/g.test(i.src)){
                        s.suffix="_src"
                    }
                    if((j=i.src.indexOf("?"))!=-1){
                        s.query=i.src.substring(j+1)
                    }
                    s.baseURL=i.src.substring(0,i.src.lastIndexOf("/"));
                    if(k&&s.baseURL.indexOf("://")==-1&&s.baseURL.indexOf("/")!==0){
                        s.baseURL=k+s.baseURL
                    }
                    return s.baseURL
                }
                return null
            }
            f=q.getElementsByTagName("script");
            for(m=0;m<f.length;m++){
                if(h(f[m])){
                    return
                }
            }
            l=q.getElementsByTagName("head")[0];
            if(l){
                f=l.getElementsByTagName("script");
                for(m=0;m<f.length;m++){
                    if(h(f[m])){
                        return
                    }
                }
            }
            return
        },
        is:function(g,f){
            if(!f){
                return g!==e
            }
            if(f=="array"&&(g.hasOwnProperty&&g instanceof Array)){
                return true
            }
            return typeof(g)==f
        },
        makeMap:function(f,j,h){
            var g;
            f=f||[];
            j=j||",";
            if(typeof(f)=="string"){
                f=f.split(j)
            }
            h=h||{};
    
            g=f.length;
            while(g--){
                h[f[g]]={}
            }
            return h
        },
        each:function(i,f,h){
            var j,g;
            if(!i){
                return 0
            }
            h=h||i;
            if(i.length!==e){
                for(j=0,g=i.length;j<g;j++){
                    if(f.call(h,i[j],j,i)===false){
                        return 0
                    }
                }
            }else{
                for(j in i){
                    if(i.hasOwnProperty(j)){
                        if(f.call(h,i[j],j,i)===false){
                            return 0
                        }
                    }
                }
            }
            return 1
        },
        map:function(g,h){
            var i=[];
            b.each(g,function(f){
                i.push(h(f))
            });
            return i
        },
        grep:function(g,h){
            var i=[];
            b.each(g,function(f){
                if(!h||h(f)){
                    i.push(f)
                }
            });
            return i
        },
        inArray:function(g,h){
            var j,f;
            if(g){
                for(j=0,f=g.length;j<f;j++){
                    if(g[j]===h){
                        return j
                    }
                }
            }
            return -1
        },
        extend:function(k,j){
            var h,g,f=arguments;
            for(h=1,g=f.length;h<g;h++){
                j=f[h];
                b.each(j,function(i,l){
                    if(i!==e){
                        k[l]=i
                    }
                })
            }
            return k
        },
        trim:function(f){
            return(f?""+f:"").replace(a,"")
        },
        create:function(o,f,j){
            var n=this,g,i,k,l,h,m=0;
            o=/^((static) )?([\w.]+)(:([\w.]+))?/.exec(o);
            k=o[3].match(/(^|\.)(\w+)$/i)[2];
            i=n.createNS(o[3].replace(/\.\w+$/,""),j);
            if(i[k]){
                return
            }
            if(o[2]=="static"){
                i[k]=f;
                if(this.onCreate){
                    this.onCreate(o[2],o[3],i[k])
                }
                return
            }
            if(!f[k]){
                f[k]=function(){};
        
                m=1
            }
            i[k]=f[k];
            n.extend(i[k].prototype,f);
            if(o[5]){
                g=n.resolve(o[5]).prototype;
                l=o[5].match(/\.(\w+)$/i)[1];
                h=i[k];
                if(m){
                    i[k]=function(){
                        return g[l].apply(this,arguments)
                    }
                }else{
                    i[k]=function(){
                        this.parent=g[l];
                        return h.apply(this,arguments)
                    }
                }
                i[k].prototype[k]=i[k];
                n.each(g,function(p,q){
                    i[k].prototype[q]=g[q]
                });
                n.each(f,function(p,q){
                    if(g[q]){
                        i[k].prototype[q]=function(){
                            this.parent=g[q];
                            return p.apply(this,arguments)
                        }
                    }else{
                        if(q!=k){
                            i[k].prototype[q]=p
                        }
                    }
                })
            }
            n.each(f["static"],function(p,q){
                i[k][q]=p
            });
            if(this.onCreate){
                this.onCreate(o[2],o[3],i[k].prototype)
            }
        },
        walk:function(i,h,j,g){
            g=g||this;
            if(i){
                if(j){
                    i=i[j]
                }
                b.each(i,function(k,f){
                    if(h.call(g,k,f,j)===false){
                        return false
                    }
                    b.walk(k,h,j,g)
                })
            }
        },
        createNS:function(j,h){
            var g,f;
            h=h||d;
            j=j.split(".");
            for(g=0;g<j.length;g++){
                f=j[g];
                if(!h[f]){
                    h[f]={}
                }
                h=h[f]
            }
            return h
        },
        resolve:function(j,h){
            var g,f;
            h=h||d;
            j=j.split(".");
            for(g=0,f=j.length;g<f;g++){
                h=h[j[g]];
                if(!h){
                    break
                }
            }
            return h
        },
        addUnload:function(j,i){
            var h=this;
            j={
                func:j,
                scope:i||this
            };
        
            if(!h.unloads){
                function g(){
                    var f=h.unloads,l,m;
                    if(f){
                        for(m in f){
                            l=f[m];
                            if(l&&l.func){
                                l.func.call(l.scope,1)
                            }
                        }
                        if(d.detachEvent){
                            d.detachEvent("onbeforeunload",k);
                            d.detachEvent("onunload",g)
                        }else{
                            if(d.removeEventListener){
                                d.removeEventListener("unload",g,false)
                            }
                        }
                        h.unloads=l=f=w=g=0;
                        if(d.CollectGarbage){
                            CollectGarbage()
                        }
                    }
                }
                function k(){
                    var l=document;
                    if(l.readyState=="interactive"){
                        function f(){
                            l.detachEvent("onstop",f);
                            if(g){
                                g()
                            }
                            l=0
                        }
                        if(l){
                            l.attachEvent("onstop",f)
                        }
                        d.setTimeout(function(){
                            if(l){
                                l.detachEvent("onstop",f)
                            }
                        },0)
                    }
                }
                if(d.attachEvent){
                    d.attachEvent("onunload",g);
                    d.attachEvent("onbeforeunload",k)
                }else{
                    if(d.addEventListener){
                        d.addEventListener("unload",g,false)
                    }
                }
                h.unloads=[j]
            }else{
                h.unloads.push(j)
            }
            return j
        },
        removeUnload:function(i){
            var g=this.unloads,h=null;
            b.each(g,function(j,f){
                if(j&&j.func==i){
                    g.splice(f,1);
                    h=i;
                    return false
                }
            });
            return h
        },
        explode:function(f,g){
            return f?b.map(f.split(g||","),b.trim):f
        },
        _addVer:function(g){
            var f;
            if(!this.query){
                return g
            }
            f=(g.indexOf("?")==-1?"?":"&")+this.query;
            if(g.indexOf("#")==-1){
                return g+f
            }
            return g.replace("#",f+"#")
        },
        _replace:function(h,f,g){
            if(c){
                return g.replace(h,function(){
                    var l=f,j=arguments,k;
                    for(k=0;k<j.length-2;k++){
                        if(j[k]===e){
                            l=l.replace(new RegExp("\\$"+k,"g"),"")
                        }else{
                            l=l.replace(new RegExp("\\$"+k,"g"),j[k])
                        }
                    }
                    return l
                })
            }
            return g.replace(h,f)
        }
    };

    b._init();
    d.tinymce=d.tinyMCE=b
})(window);
tinymce.create("tinymce.util.Dispatcher",{
    scope:null,
    listeners:null,
    Dispatcher:function(a){
        this.scope=a||this;
        this.listeners=[]
    },
    add:function(a,b){
        this.listeners.push({
            cb:a,
            scope:b||this.scope
        });
        return a
    },
    addToTop:function(a,b){
        this.listeners.unshift({
            cb:a,
            scope:b||this.scope
        });
        return a
    },
    remove:function(a){
        var b=this.listeners,c=null;
        tinymce.each(b,function(e,d){
            if(a==e.cb){
                c=a;
                b.splice(d,1);
                return false
            }
        });
        return c
    },
    dispatch:function(){
        var f,d=arguments,e,b=this.listeners,g;
        for(e=0;e<b.length;e++){
            g=b[e];
            f=g.cb.apply(g.scope,d);
            if(f===false){
                break
            }
        }
        return f
    }
});
(function(){
    var a=tinymce.each;
    tinymce.create("tinymce.util.URI",{
        URI:function(e,g){
            var f=this,h,d,c;
            e=tinymce.trim(e);
            g=f.settings=g||{};
            
            if(/^(mailto|tel|news|javascript|about|data):/i.test(e)||/^\s*#/.test(e)){
                f.source=e;
                return
            }
            if(e.indexOf("/")===0&&e.indexOf("//")!==0){
                e=(g.base_uri?g.base_uri.protocol||"http":"http")+"://mce_host"+e
            }
            if(!/^\w*:?\/\//.test(e)){
                e=(g.base_uri.protocol||"http")+"://mce_host"+f.toAbsPath(g.base_uri.path,e)
            }
            e=e.replace(/@@/g,"(mce_at)");
            e=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e);
            a(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],function(b,j){
                var k=e[j];
                if(k){
                    k=k.replace(/\(mce_at\)/g,"@@")
                }
                f[b]=k
            });
            if(c=g.base_uri){
                if(!f.protocol){
                    f.protocol=c.protocol
                }
                if(!f.userInfo){
                    f.userInfo=c.userInfo
                }
                if(!f.port&&f.host=="mce_host"){
                    f.port=c.port
                }
                if(!f.host||f.host=="mce_host"){
                    f.host=c.host
                }
                f.source=""
            }
        },
        setPath:function(c){
            var b=this;
            c=/^(.*?)\/?(\w+)?$/.exec(c);
            b.path=c[0];
            b.directory=c[1];
            b.file=c[2];
            b.source="";
            b.getURI()
        },
        toRelative:function(b){
            var c=this,d;
            if(b==="./"){
                return b
            }
            b=new tinymce.util.URI(b,{
                base_uri:c
            });
            if((b.host!="mce_host"&&c.host!=b.host&&b.host)||c.port!=b.port||c.protocol!=b.protocol){
                return b.getURI()
            }
            d=c.toRelPath(c.path,b.path);
            if(b.query){
                d+="?"+b.query
            }
            if(b.anchor){
                d+="#"+b.anchor
            }
            return d
        },
        toAbsolute:function(b,c){
            var b=new tinymce.util.URI(b,{
                base_uri:this
            });
            return b.getURI(this.host==b.host&&this.protocol==b.protocol?c:0)
        },
        toRelPath:function(g,h){
            var c,f=0,d="",e,b;
            g=g.substring(0,g.lastIndexOf("/"));
            g=g.split("/");
            c=h.split("/");
            if(g.length>=c.length){
                for(e=0,b=g.length;e<b;e++){
                    if(e>=c.length||g[e]!=c[e]){
                        f=e+1;
                        break
                    }
                }
            }
            if(g.length<c.length){
                for(e=0,b=c.length;e<b;e++){
                    if(e>=g.length||g[e]!=c[e]){
                        f=e+1;
                        break
                    }
                }
            }
            if(f==1){
                return h
            }
            for(e=0,b=g.length-(f-1);e<b;e++){
                d+="../"
            }
            for(e=f-1,b=c.length;e<b;e++){
                if(e!=f-1){
                    d+="/"+c[e]
                }else{
                    d+=c[e]
                }
            }
            return d
        },
        toAbsPath:function(e,f){
            var c,b=0,h=[],d,g;
            d=/\/$/.test(f)?"/":"";
            e=e.split("/");
            f=f.split("/");
            a(e,function(i){
                if(i){
                    h.push(i)
                }
            });
            e=h;
            for(c=f.length-1,h=[];c>=0;c--){
                if(f[c].length==0||f[c]=="."){
                    continue
                }
                if(f[c]==".."){
                    b++;
                    continue
                }
                if(b>0){
                    b--;
                    continue
                }
                h.push(f[c])
            }
            c=e.length-b;
            if(c<=0){
                g=h.reverse().join("/")
            }else{
                g=e.slice(0,c).join("/")+"/"+h.reverse().join("/")
            }
            if(g.indexOf("/")!==0){
                g="/"+g
            }
            if(d&&g.lastIndexOf("/")!==g.length-1){
                g+=d
            }
            return g
        },
        getURI:function(d){
            var c,b=this;
            if(!b.source||d){
                c="";
                if(!d){
                    if(b.protocol){
                        c+=b.protocol+"://"
                    }
                    if(b.userInfo){
                        c+=b.userInfo+"@"
                    }
                    if(b.host){
                        c+=b.host
                    }
                    if(b.port){
                        c+=":"+b.port
                    }
                }
                if(b.path){
                    c+=b.path
                }
                if(b.query){
                    c+="?"+b.query
                }
                if(b.anchor){
                    c+="#"+b.anchor
                }
                b.source=c
            }
            return b.source
        }
    })
})();
(function(){
    var a=tinymce.each;
    tinymce.create("static tinymce.util.Cookie",{
        getHash:function(d){
            var b=this.get(d),c;
            if(b){
                a(b.split("&"),function(e){
                    e=e.split("=");
                    c=c||{};
                    
                    c[unescape(e[0])]=unescape(e[1])
                })
            }
            return c
        },
        setHash:function(j,b,g,f,i,c){
            var h="";
            a(b,function(e,d){
                h+=(!h?"":"&")+escape(d)+"="+escape(e)
            });
            this.set(j,h,g,f,i,c)
        },
        get:function(i){
            var h=document.cookie,g,f=i+"=",d;
            if(!h){
                return
            }
            d=h.indexOf("; "+f);
            if(d==-1){
                d=h.indexOf(f);
                if(d!=0){
                    return null
                }
            }else{
                d+=2
            }
            g=h.indexOf(";",d);
            if(g==-1){
                g=h.length
            }
            return unescape(h.substring(d+f.length,g))
        },
        set:function(i,b,g,f,h,c){
            document.cookie=i+"="+escape(b)+((g)?"; expires="+g.toGMTString():"")+((f)?"; path="+escape(f):"")+((h)?"; domain="+h:"")+((c)?"; secure":"")
        },
        remove:function(e,b){
            var c=new Date();
            c.setTime(c.getTime()-1000);
            this.set(e,"",c,b,c)
        }
    })
})();
(function(){
    function serialize(o,quote){
        var i,v,t;
        quote=quote||'"';
        if(o==null){
            return"null"
        }
        t=typeof o;
        if(t=="string"){
            v="\bb\tt\nn\ff\rr\"\"''\\\\";
            return quote+o.replace(/([\u0080-\uFFFF\x00-\x1f\"\'\\])/g,function(a,b){
                if(quote==='"'&&a==="'"){
                    return a
                }
                i=v.indexOf(b);
                if(i+1){
                    return"\\"+v.charAt(i+1)
                }
                a=b.charCodeAt().toString(16);
                return"\\u"+"0000".substring(a.length)+a
            })+quote
        }
        if(t=="object"){
            if(o.hasOwnProperty&&o instanceof Array){
                for(i=0,v="[";i<o.length;i++){
                    v+=(i>0?",":"")+serialize(o[i],quote)
                }
                return v+"]"
            }
            v="{";
            for(i in o){
                v+=typeof o[i]!="function"?(v.length>1?","+quote:quote)+i+quote+":"+serialize(o[i],quote):""
            }
            return v+"}"
        }
        return""+o
    }
    tinymce.util.JSON={
        serialize:serialize,
        parse:function(s){
            try{
                return eval("("+s+")")
            }catch(ex){}
        }
    }
})();
tinymce.create("static tinymce.util.XHR",{
    send:function(g){
        var a,e,b=window,h=0;
        g.scope=g.scope||this;
        g.success_scope=g.success_scope||g.scope;
        g.error_scope=g.error_scope||g.scope;
        g.async=g.async===false?false:true;
        g.data=g.data||"";
        function d(i){
            a=0;
            try{
                a=new ActiveXObject(i)
            }catch(c){}
            return a
        }
        a=b.XMLHttpRequest?new XMLHttpRequest():d("Microsoft.XMLHTTP")||d("Msxml2.XMLHTTP");
        if(a){
            if(a.overrideMimeType){
                a.overrideMimeType(g.content_type)
            }
            a.open(g.type||(g.data?"POST":"GET"),g.url,g.async);
            if(g.content_type){
                a.setRequestHeader("Content-Type",g.content_type)
            }
            a.setRequestHeader("X-Requested-With","XMLHttpRequest");
            a.send(g.data);
            function f(){
                if(!g.async||a.readyState==4||h++>10000){
                    if(g.success&&h<10000&&a.status==200){
                        g.success.call(g.success_scope,""+a.responseText,a,g)
                    }else{
                        if(g.error){
                            g.error.call(g.error_scope,h>10000?"TIMED_OUT":"GENERAL",a,g)
                        }
                    }
                    a=null
                }else{
                    b.setTimeout(f,10)
                }
            }
            if(!g.async){
                return f()
            }
            e=b.setTimeout(f,10)
        }
    }
});
(function(){
    var c=tinymce.extend,b=tinymce.util.JSON,a=tinymce.util.XHR;
    tinymce.create("tinymce.util.JSONRequest",{
        JSONRequest:function(d){
            this.settings=c({},d);
            this.count=0
        },
        send:function(f){
            var e=f.error,d=f.success;
            f=c(this.settings,f);
            f.success=function(h,g){
                h=b.parse(h);
                if(typeof(h)=="undefined"){
                    h={
                        error:"JSON Parse error."
                    }
                }
                if(h.error){
                    e.call(f.error_scope||f.scope,h.error,g)
                }else{
                    d.call(f.success_scope||f.scope,h.result)
                }
            };
        
            f.error=function(h,g){
                if(e){
                    e.call(f.error_scope||f.scope,h,g)
                }
            };
    
            f.data=b.serialize({
                id:f.id||"c"+(this.count++),
                method:f.method,
                params:f.params
            });
            f.content_type="application/json";
            a.send(f)
        },
        "static":{
            sendRPC:function(d){
                return new tinymce.util.JSONRequest().send(d)
            }
        }
    })
}());
(function(j){
    var a,g,d,k=/[&\"\u007E-\uD7FF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,b=/[<>&\u007E-\uD7FF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,f=/[<>&\"\']/g,c=/&(#)?([\w]+);/g,i={
        128:"\u20AC",
        130:"\u201A",
        131:"\u0192",
        132:"\u201E",
        133:"\u2026",
        134:"\u2020",
        135:"\u2021",
        136:"\u02C6",
        137:"\u2030",
        138:"\u0160",
        139:"\u2039",
        140:"\u0152",
        142:"\u017D",
        145:"\u2018",
        146:"\u2019",
        147:"\u201C",
        148:"\u201D",
        149:"\u2022",
        150:"\u2013",
        151:"\u2014",
        152:"\u02DC",
        153:"\u2122",
        154:"\u0161",
        155:"\u203A",
        156:"\u0153",
        158:"\u017E",
        159:"\u0178"
    };
    
    g={
        '"':"&quot;",
        "'":"&#39;",
        "<":"&lt;",
        ">":"&gt;",
        "&":"&amp;"
    };
    
    d={
        "&lt;":"<",
        "&gt;":">",
        "&amp;":"&",
        "&quot;":'"',
        "&apos;":"'"
    };
    
    function h(l){
        var m;
        m=document.createElement("div");
        m.innerHTML=l;
        return m.textContent||m.innerText||l
    }
    function e(m,p){
        var n,o,l,q={};
        
        if(m){
            m=m.split(",");
            p=p||10;
            for(n=0;n<m.length;n+=2){
                o=String.fromCharCode(parseInt(m[n],p));
                if(!g[o]){
                    l="&"+m[n+1]+";";
                    q[o]=l;
                    q[l]=o
                }
            }
            return q
        }
    }
    a=e("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro",32);
    j.html=j.html||{};
    
    j.html.Entities={
        encodeRaw:function(m,l){
            return m.replace(l?k:b,function(n){
                return g[n]||n
            })
        },
        encodeAllRaw:function(l){
            return(""+l).replace(f,function(m){
                return g[m]||m
            })
        },
        encodeNumeric:function(m,l){
            return m.replace(l?k:b,function(n){
                if(n.length>1){
                    return"&#"+(((n.charCodeAt(0)-55296)*1024)+(n.charCodeAt(1)-56320)+65536)+";"
                }
                return g[n]||"&#"+n.charCodeAt(0)+";"
            })
        },
        encodeNamed:function(n,l,m){
            m=m||a;
            return n.replace(l?k:b,function(o){
                return g[o]||m[o]||o
            })
        },
        getEncodeFunc:function(l,o){
            var p=j.html.Entities;
            o=e(o)||a;
            function m(r,q){
                return r.replace(q?k:b,function(s){
                    return g[s]||o[s]||"&#"+s.charCodeAt(0)+";"||s
                })
            }
            function n(r,q){
                return p.encodeNamed(r,q,o)
            }
            l=j.makeMap(l.replace(/\+/g,","));
            if(l.named&&l.numeric){
                return m
            }
            if(l.named){
                if(o){
                    return n
                }
                return p.encodeNamed
            }
            if(l.numeric){
                return p.encodeNumeric
            }
            return p.encodeRaw
        },
        decode:function(l){
            return l.replace(c,function(n,m,o){
                if(m){
                    o=parseInt(o);
                    if(o>65535){
                        o-=65536;
                        return String.fromCharCode(55296+(o>>10),56320+(o&1023))
                    }else{
                        return i[o]||String.fromCharCode(o)
                    }
                }
                return d[n]||a[n]||h(n)
            })
        }
    }
})(tinymce);
tinymce.html.Styles=function(d,f){
    var k=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi,h=/(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi,b=/\s*([^:]+):\s*([^;]+);?/g,l=/\s+$/,m=/rgb/,e,g,a={},j;
    d=d||{};
    
    j="\\\" \\' \\; \\: ; : _".split(" ");
    for(g=0;g<j.length;g++){
        a[j[g]]="_"+g;
        a["_"+g]=j[g]
    }
    function c(n,q,p,i){
        function o(r){
            r=parseInt(r).toString(16);
            return r.length>1?r:"0"+r
        }
        return"#"+o(q)+o(p)+o(i)
    }
    return{
        toHex:function(i){
            return i.replace(k,c)
        },
        parse:function(r){
            var y={},p,n,v,q,u=d.url_converter,x=d.url_converter_scope||this;
            function o(C,F){
                var E,B,A,D;
                E=y[C+"-top"+F];
                if(!E){
                    return
                }
                B=y[C+"-right"+F];
                if(E!=B){
                    return
                }
                A=y[C+"-bottom"+F];
                if(B!=A){
                    return
                }
                D=y[C+"-left"+F];
                if(A!=D){
                    return
                }
                y[C+F]=D;
                delete y[C+"-top"+F];
                delete y[C+"-right"+F];
                delete y[C+"-bottom"+F];
                delete y[C+"-left"+F]
            }
            function t(B){
                var C=y[B],A;
                if(!C||C.indexOf(" ")<0){
                    return
                }
                C=C.split(" ");
                A=C.length;
                while(A--){
                    if(C[A]!==C[0]){
                        return false
                    }
                }
                y[B]=C[0];
                return true
            }
            function z(C,B,A,D){
                if(!t(B)){
                    return
                }
                if(!t(A)){
                    return
                }
                if(!t(D)){
                    return
                }
                y[C]=y[B]+" "+y[A]+" "+y[D];
                delete y[B];
                delete y[A];
                delete y[D]
            }
            function s(A){
                q=true;
                return a[A]
            }
            function i(B,A){
                if(q){
                    B=B.replace(/_[0-9]/g,function(C){
                        return a[C]
                    })
                }
                if(!A){
                    B=B.replace(/\\([\'\";:])/g,"$1")
                }
                return B
            }
            if(r){
                r=r.replace(/\\[\"\';:_]/g,s).replace(/\"[^\"]+\"|\'[^\']+\'/g,function(A){
                    return A.replace(/[;:]/g,s)
                });
                while(p=b.exec(r)){
                    n=p[1].replace(l,"").toLowerCase();
                    v=p[2].replace(l,"");
                    if(n&&v.length>0){
                        if(n==="font-weight"&&v==="700"){
                            v="bold"
                        }else{
                            if(n==="color"||n==="background-color"){
                                v=v.toLowerCase()
                            }
                        }
                        v=v.replace(k,c);
                        v=v.replace(h,function(B,A,E,D,F,C){
                            F=F||C;
                            if(F){
                                F=i(F);
                                return"'"+F.replace(/\'/g,"\\'")+"'"
                            }
                            A=i(A||E||D);
                            if(u){
                                A=u.call(x,A,"style")
                            }
                            return"url('"+A.replace(/\'/g,"\\'")+"')"
                        });
                        y[n]=q?i(v,true):v
                    }
                    b.lastIndex=p.index+p[0].length
                }
                o("border","");
                o("border","-width");
                o("border","-color");
                o("border","-style");
                o("padding","");
                o("margin","");
                z("border","border-width","border-style","border-color");
                if(y.border==="medium none"){
                    delete y.border
                }
            }
            return y
        },
        serialize:function(p,r){
            var o="",n,q;
            function i(t){
                var x,u,s,t,v;
                x=f.styles[t];
                if(x){
                    for(u=0,s=x.length;u<s;u++){
                        t=x[u];
                        v=p[t];
                        if(v!==e&&v.length>0){
                            o+=(o.length>0?" ":"")+t+": "+v+";"
                        }
                    }
                }
            }
            if(r&&f&&f.styles){
                i("*");
                i(n)
            }else{
                for(n in p){
                    q=p[n];
                    if(q!==e&&q.length>0){
                        o+=(o.length>0?" ":"")+n+": "+q+";"
                    }
                }
            }
            return o
        }
    }
};
(function(l){
    var g={},i,k,f,d,b,e,c=l.makeMap,j=l.each;
    function h(n,m){
        return n.split(m||",")
    }
    function a(q,p){
        var n,o={};
        
        function m(r){
            return r.replace(/[A-Z]+/g,function(s){
                return m(q[s])
            })
        }
        for(n in q){
            if(q.hasOwnProperty(n)){
                q[n]=m(q[n])
            }
        }
        m(p).replace(/#/g,"#text").replace(/(\w+)\[([^\]]+)\]\[([^\]]*)\]/g,function(u,s,r,t){
            r=h(r,"|");
            o[s]={
                attributes:c(r),
                attributesOrder:r,
                children:c(t,"|",{
                    "#comment":{}
                })
            }
        });
        return o
    }
    k="h1,h2,h3,h4,h5,h6,hr,p,div,address,pre,form,table,tbody,thead,tfoot,th,tr,td,li,ol,ul,caption,blockquote,center,dl,dt,dd,dir,fieldset,noscript,menu,isindex,samp,header,footer,article,section,hgroup";
    k=c(k,",",c(k.toUpperCase()));
    g=a({
        Z:"H|K|N|O|P",
        Y:"X|form|R|Q",
        ZG:"E|span|width|align|char|charoff|valign",
        X:"p|T|div|U|W|isindex|fieldset|table",
        ZF:"E|align|char|charoff|valign",
        W:"pre|hr|blockquote|address|center|noframes",
        ZE:"abbr|axis|headers|scope|rowspan|colspan|align|char|charoff|valign|nowrap|bgcolor|width|height",
        ZD:"[E][S]",
        U:"ul|ol|dl|menu|dir",
        ZC:"p|Y|div|U|W|table|br|span|bdo|object|applet|img|map|K|N|Q",
        T:"h1|h2|h3|h4|h5|h6",
        ZB:"X|S|Q",
        S:"R|P",
        ZA:"a|G|J|M|O|P",
        R:"a|H|K|N|O",
        Q:"noscript|P",
        P:"ins|del|script",
        O:"input|select|textarea|label|button",
        N:"M|L",
        M:"em|strong|dfn|code|q|samp|kbd|var|cite|abbr|acronym",
        L:"sub|sup",
        K:"J|I",
        J:"tt|i|b|u|s|strike",
        I:"big|small|font|basefont",
        H:"G|F",
        G:"br|span|bdo",
        F:"object|applet|img|map|iframe",
        E:"A|B|C",
        D:"accesskey|tabindex|onfocus|onblur",
        C:"onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup",
        B:"lang|xml:lang|dir",
        A:"id|class|style|title"
    },"script[id|charset|type|language|src|defer|xml:space][]style[B|id|type|media|title|xml:space][]object[E|declare|classid|codebase|data|type|codetype|archive|standby|width|height|usemap|name|tabindex|align|border|hspace|vspace][#|param|Y]param[id|name|value|valuetype|type][]p[E|align][#|S]a[E|D|charset|type|name|href|hreflang|rel|rev|shape|coords|target][#|Z]br[A|clear][]span[E][#|S]bdo[A|C|B][#|S]applet[A|codebase|archive|code|object|alt|name|width|height|align|hspace|vspace][#|param|Y]h1[E|align][#|S]img[E|src|alt|name|longdesc|width|height|usemap|ismap|align|border|hspace|vspace][]map[B|C|A|name][X|form|Q|area]h2[E|align][#|S]iframe[A|longdesc|name|src|frameborder|marginwidth|marginheight|scrolling|align|width|height][#|Y]h3[E|align][#|S]tt[E][#|S]i[E][#|S]b[E][#|S]u[E][#|S]s[E][#|S]strike[E][#|S]big[E][#|S]small[E][#|S]font[A|B|size|color|face][#|S]basefont[id|size|color|face][]em[E][#|S]strong[E][#|S]dfn[E][#|S]code[E][#|S]q[E|cite][#|S]samp[E][#|S]kbd[E][#|S]var[E][#|S]cite[E][#|S]abbr[E][#|S]acronym[E][#|S]sub[E][#|S]sup[E][#|S]input[E|D|type|name|value|checked|disabled|readonly|size|maxlength|src|alt|usemap|onselect|onchange|accept|align][]select[E|name|size|multiple|disabled|tabindex|onfocus|onblur|onchange][optgroup|option]optgroup[E|disabled|label][option]option[E|selected|disabled|label|value][]textarea[E|D|name|rows|cols|disabled|readonly|onselect|onchange][]label[E|for|accesskey|onfocus|onblur][#|S]button[E|D|name|value|type|disabled][#|p|T|div|U|W|table|G|object|applet|img|map|K|N|Q]h4[E|align][#|S]ins[E|cite|datetime][#|Y]h5[E|align][#|S]del[E|cite|datetime][#|Y]h6[E|align][#|S]div[E|align][#|Y]ul[E|type|compact][li]li[E|type|value][#|Y]ol[E|type|compact|start][li]dl[E|compact][dt|dd]dt[E][#|S]dd[E][#|Y]menu[E|compact][li]dir[E|compact][li]pre[E|width|xml:space][#|ZA]hr[E|align|noshade|size|width][]blockquote[E|cite][#|Y]address[E][#|S|p]center[E][#|Y]noframes[E][#|Y]isindex[A|B|prompt][]fieldset[E][#|legend|Y]legend[E|accesskey|align][#|S]table[E|summary|width|border|frame|rules|cellspacing|cellpadding|align|bgcolor][caption|col|colgroup|thead|tfoot|tbody|tr]caption[E|align][#|S]col[ZG][]colgroup[ZG][col]thead[ZF][tr]tr[ZF|bgcolor][th|td]th[E|ZE][#|Y]form[E|action|method|name|enctype|onsubmit|onreset|accept|accept-charset|target][#|X|R|Q]noscript[E][#|Y]td[E|ZE][#|Y]tfoot[ZF][tr]tbody[ZF][tr]area[E|D|shape|coords|href|nohref|alt|target][]base[id|href|target][]body[E|onload|onunload|background|bgcolor|text|link|vlink|alink][#|Y]");
    i=c("checked,compact,declare,defer,disabled,ismap,multiple,nohref,noresize,noshade,nowrap,readonly,selected,preload,autoplay,loop,controls");
    f=c("area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed,source");
    d=l.extend(c("td,th,iframe,video,object"),f);
    b=c("pre,script,style");
    e=c("colgroup,dd,dt,li,options,p,td,tfoot,th,thead,tr");
    l.html.Schema=function(p){
        var x=this,m={},n={},u=[],o;
        p=p||{};
    
        if(p.verify_html===false){
            p.valid_elements="*[*]"
        }
        if(p.valid_styles){
            o={};
        
            j(p.valid_styles,function(z,y){
                o[y]=l.explode(z)
            })
        }
        function v(y){
            return new RegExp("^"+y.replace(/([?+*])/g,".$1")+"$")
        }
        function r(F){
            var E,A,T,P,U,z,C,O,R,K,S,W,I,D,Q,y,M,B,V,X,J,N,H=/^([#+-])?([^\[\/]+)(?:\/([^\[]+))?(?:\[([^\]]+)\])?$/,L=/^([!\-])?(\w+::\w+|[^=:<]+)?(?:([=:<])(.*))?$/,G=/[*?+]/;
            if(F){
                F=h(F);
                if(m["@"]){
                    M=m["@"].attributes;
                    B=m["@"].attributesOrder
                }
                for(E=0,A=F.length;E<A;E++){
                    z=H.exec(F[E]);
                    if(z){
                        Q=z[1];
                        K=z[2];
                        y=z[3];
                        R=z[4];
                        I={};
                    
                        D=[];
                        C={
                            attributes:I,
                            attributesOrder:D
                        };
                    
                        if(Q==="#"){
                            C.paddEmpty=true
                        }
                        if(Q==="-"){
                            C.removeEmpty=true
                        }
                        if(M){
                            for(X in M){
                                I[X]=M[X]
                            }
                            D.push.apply(D,B)
                        }
                        if(R){
                            R=h(R,"|");
                            for(T=0,P=R.length;T<P;T++){
                                z=L.exec(R[T]);
                                if(z){
                                    O={};
                                
                                    W=z[1];
                                    S=z[2].replace(/::/g,":");
                                    Q=z[3];
                                    N=z[4];
                                    if(W==="!"){
                                        C.attributesRequired=C.attributesRequired||[];
                                        C.attributesRequired.push(S);
                                        O.required=true
                                    }
                                    if(W==="-"){
                                        delete I[S];
                                        D.splice(l.inArray(D,S),1);
                                        continue
                                    }
                                    if(Q){
                                        if(Q==="="){
                                            C.attributesDefault=C.attributesDefault||[];
                                            C.attributesDefault.push({
                                                name:S,
                                                value:N
                                            });
                                            O.defaultValue=N
                                        }
                                        if(Q===":"){
                                            C.attributesForced=C.attributesForced||[];
                                            C.attributesForced.push({
                                                name:S,
                                                value:N
                                            });
                                            O.forcedValue=N
                                        }
                                        if(Q==="<"){
                                            O.validValues=c(N,"?")
                                        }
                                    }
                                    if(G.test(S)){
                                        C.attributePatterns=C.attributePatterns||[];
                                        O.pattern=v(S);
                                        C.attributePatterns.push(O)
                                    }else{
                                        if(!I[S]){
                                            D.push(S)
                                        }
                                        I[S]=O
                                    }
                                }
                            }
                        }
                        if(!M&&K=="@"){
                            M=I;
                            B=D
                        }
                        if(y){
                            C.outputName=K;
                            m[y]=C
                        }
                        if(G.test(K)){
                            C.pattern=v(K);
                            u.push(C)
                        }else{
                            m[K]=C
                        }
                    }
                }
            }
        }
        function t(y){
            m={};
    
            u=[];
            r(y);
            j(g,function(A,z){
                n[z]=A.children
            })
        }
        function q(z){
            var y=/^(~)?(.+)$/;
            if(z){
                j(h(z),function(C){
                    var B=y.exec(C),D=B[1]==="~"?"span":"div",A=B[2];
                    n[A]=n[D];
                    j(n,function(E,F){
                        if(E[D]){
                            E[A]=E[D]
                        }
                    })
                })
            }
        }
        function s(z){
            var y=/^([+\-]?)(\w+)\[([^\]]+)\]$/;
            if(z){
                j(h(z),function(D){
                    var C=y.exec(D),A,B;
                    if(C){
                        B=C[1];
                        if(B){
                            A=n[C[2]]
                        }else{
                            A=n[C[2]]={
                                "#comment":{}
                            }
                        }
                        A=n[C[2]];
                        j(h(C[3],"|"),function(E){
                            if(B==="-"){
                                delete A[E]
                            }else{
                                A[E]={}
                            }
                        })
                    }
                })
            }
        }
        if(!p.valid_elements){
            j(g,function(z,y){
                m[y]={
                    attributes:z.attributes,
                    attributesOrder:z.attributesOrder
                };
            
                n[y]=z.children
            });
            j(h("strong/b,em/i"),function(y){
                y=h(y,"/");
                m[y[1]].outputName=y[0]
            });
            m.img.attributesDefault=[{
                name:"alt",
                value:""
            }];
            j(h("ol,ul,li,sub,sup,blockquote,tr,div,span,font,a,table,tbody"),function(y){
                m[y].removeEmpty=true
            });
            j(h("p,h1,h2,h3,h4,h5,h6,th,td,pre,div,address,caption"),function(y){
                m[y].paddEmpty=true
            })
        }else{
            t(p.valid_elements)
        }
        q(p.custom_elements);
        s(p.valid_children);
        r(p.extended_valid_elements);
        s("+ol[ul|ol],+ul[ul|ol]");
        if(p.invalid_elements){
            l.each(l.explode(p.invalid_elements),function(y){
                if(m[y]){
                    delete m[y]
                }
            })
        }
        x.children=n;
        x.styles=o;
        x.getBoolAttrs=function(){
            return i
        };
    
        x.getBlockElements=function(){
            return k
        };
    
        x.getShortEndedElements=function(){
            return f
        };
    
        x.getSelfClosingElements=function(){
            return e
        };
    
        x.getNonEmptyElements=function(){
            return d
        };
    
        x.getWhiteSpaceElements=function(){
            return b
        };
    
        x.isValidChild=function(y,A){
            var z=n[y];
            return !!(z&&z[A])
        };
    
        x.getElementRule=function(y){
            var A=m[y],z;
            if(A){
                return A
            }
            z=u.length;
            while(z--){
                A=u[z];
                if(A.pattern.test(y)){
                    return A
                }
            }
        };

        x.addValidElements=r;
        x.setValidElements=t;
        x.addCustomElements=q;
        x.addValidChildren=s
    };

    l.html.Schema.boolAttrMap=i;
    l.html.Schema.blockElementsMap=k
})(tinymce);
(function(a){
    a.html.SaxParser=function(c,e){
        var b=this,d=function(){};
        
        c=c||{};
        
        b.schema=e=e||new a.html.Schema();
        if(c.fix_self_closing!==false){
            c.fix_self_closing=true
        }
        a.each("comment cdata text start end pi doctype".split(" "),function(f){
            if(f){
                b[f]=c[f]||d
            }
        });
        b.parse=function(q){
            var A=this,f,m=0,G,j,l=[],B,K,t,N,F,k,p,x,I,r,E,o,J,n,H,M,L,z,D,h,g,u,s=0,v=a.html.Entities.decode,y;
            function C(O){
                var Q,P;
                Q=l.length;
                while(Q--){
                    if(l[Q].name===O){
                        break
                    }
                }
                if(Q>=0){
                    for(P=l.length-1;P>=Q;P--){
                        O=l[P];
                        if(O.valid){
                            A.end(O.name)
                        }
                    }
                    l.length=Q
                }
            }
            D=new RegExp("<(?:(?:!--([\\w\\W]*?)-->)|(?:!\\[CDATA\\[([\\w\\W]*?)\\]\\]>)|(?:!DOCTYPE([\\w\\W]*?)>)|(?:\\?([^\\s\\/<>]+) ?([\\w\\W]*?)[?/]>)|(?:\\/([^>]+)>)|(?:([^\\s\\/<>]+)\\s*((?:[^\"'>]+(?:(?:\"[^\"]*\")|(?:'[^']*')|[^>]*))*)>))","g");
            h=/([\w:\-]+)(?:\s*=\s*(?:(?:\"((?:\\.|[^\"])*)\")|(?:\'((?:\\.|[^\'])*)\')|([^>\s]+)))?/g;
            g={
                script:/<\/script[^>]*>/gi,
                style:/<\/style[^>]*>/gi,
                noscript:/<\/noscript[^>]*>/gi
            };

            F=e.getShortEndedElements();
            z=e.getSelfClosingElements();
            k=e.getBoolAttrs();
            x=c.validate;
            y=c.fix_self_closing;
            while(f=D.exec(q)){
                if(m<f.index){
                    A.text(v(q.substr(m,f.index-m)))
                }
                if(G=f[6]){
                    C(G.toLowerCase())
                }else{
                    if(G=f[7]){
                        G=G.toLowerCase();
                        p=G in F;
                        if(y&&z[G]&&l.length>0&&l[l.length-1].name===G){
                            C(G)
                        }
                        if(!x||(I=e.getElementRule(G))){
                            r=true;
                            if(x){
                                J=I.attributes;
                                n=I.attributePatterns
                            }
                            if(o=f[8]){
                                B=[];
                                B.map={};
                    
                                o.replace(h,function(P,O,T,S,R){
                                    var U,Q;
                                    O=O.toLowerCase();
                                    T=O in k?O:v(T||S||R||"");
                                    if(x&&O.indexOf("data-")!==0){
                                        U=J[O];
                                        if(!U&&n){
                                            Q=n.length;
                                            while(Q--){
                                                U=n[Q];
                                                if(U.pattern.test(O)){
                                                    break
                                                }
                                            }
                                            if(Q===-1){
                                                U=null
                                            }
                                        }
                                        if(!U){
                                            return
                                        }
                                        if(U.validValues&&!(T in U.validValues)){
                                            return
                                        }
                                    }
                                    B.map[O]=T;
                                    B.push({
                                        name:O,
                                        value:T
                                    })
                                })
                            }else{
                                B=[];
                                B.map={}
                            }
                            if(x){
                                H=I.attributesRequired;
                                M=I.attributesDefault;
                                L=I.attributesForced;
                                if(L){
                                    K=L.length;
                                    while(K--){
                                        E=L[K];
                                        N=E.name;
                                        u=E.value;
                                        if(u==="{$uid}"){
                                            u="mce_"+s++
                                        }
                                        B.map[N]=u;
                                        B.push({
                                            name:N,
                                            value:u
                                        })
                                    }
                                }
                                if(M){
                                    K=M.length;
                                    while(K--){
                                        E=M[K];
                                        N=E.name;
                                        if(!(N in B.map)){
                                            u=E.value;
                                            if(u==="{$uid}"){
                                                u="mce_"+s++
                                            }
                                            B.map[N]=u;
                                            B.push({
                                                name:N,
                                                value:u
                                            })
                                        }
                                    }
                                }
                                if(H){
                                    K=H.length;
                                    while(K--){
                                        if(H[K] in B.map){
                                            break
                                        }
                                    }
                                    if(K===-1){
                                        r=false
                                    }
                                }
                                if(B.map["data-mce-bogus"]){
                                    r=false
                                }
                            }
                            if(r){
                                A.start(G,B,p)
                            }
                        }else{
                            r=false
                        }
                        if(j=g[G]){
                            j.lastIndex=m=f.index+f[0].length;
                            if(f=j.exec(q)){
                                if(r){
                                    t=q.substr(m,f.index-m)
                                }
                                m=f.index+f[0].length
                            }else{
                                t=q.substr(m);
                                m=q.length
                            }
                            if(r&&t.length>0){
                                A.text(t,true)
                            }
                            if(r){
                                A.end(G)
                            }
                            D.lastIndex=m;
                            continue
                        }
                        if(!p){
                            if(!o||o.indexOf("/")!=o.length-1){
                                l.push({
                                    name:G,
                                    valid:r
                                })
                            }else{
                                if(r){
                                    A.end(G)
                                }
                            }
                        }
                    }else{
                        if(G=f[1]){
                            A.comment(G)
                        }else{
                            if(G=f[2]){
                                A.cdata(G)
                            }else{
                                if(G=f[3]){
                                    A.doctype(G)
                                }else{
                                    if(G=f[4]){
                                        A.pi(G,f[5])
                                    }
                                }
                            }
                        }
                    }
                }
                m=f.index+f[0].length
            }
            if(m<q.length){
                A.text(v(q.substr(m)))
            }
            for(K=l.length-1;K>=0;K--){
                G=l[K];
                if(G.valid){
                    A.end(G.name)
                }
            }
        }
    }
})(tinymce);
(function(d){
    var c=/^[ \t\r\n]*$/,e={
        "#text":3,
        "#comment":8,
        "#cdata":4,
        "#pi":7,
        "#doctype":10,
        "#document-fragment":11
    };
    
    function a(k,l,j){
        var i,h,f=j?"lastChild":"firstChild",g=j?"prev":"next";
        if(k[f]){
            return k[f]
        }
        if(k!==l){
            i=k[g];
            if(i){
                return i
            }
            for(h=k.parent;h&&h!==l;h=h.parent){
                i=h[g];
                if(i){
                    return i
                }
            }
        }
    }
    function b(f,g){
        this.name=f;
        this.type=g;
        if(g===1){
            this.attributes=[];
            this.attributes.map={}
        }
    }
    d.extend(b.prototype,{
        replace:function(g){
            var f=this;
            if(g.parent){
                g.remove()
            }
            f.insert(g,f);
            f.remove();
            return f
        },
        attr:function(h,l){
            var f=this,g,j,k;
            if(typeof h!=="string"){
                for(j in h){
                    f.attr(j,h[j])
                }
                return f
            }
            if(g=f.attributes){
                if(l!==k){
                    if(l===null){
                        if(h in g.map){
                            delete g.map[h];
                            j=g.length;
                            while(j--){
                                if(g[j].name===h){
                                    g=g.splice(j,1);
                                    return f
                                }
                            }
                        }
                        return f
                    }
                    if(h in g.map){
                        j=g.length;
                        while(j--){
                            if(g[j].name===h){
                                g[j].value=l;
                                break
                            }
                        }
                    }else{
                        g.push({
                            name:h,
                            value:l
                        })
                    }
                    g.map[h]=l;
                    return f
                }else{
                    return g.map[h]
                }
            }
        },
        clone:function(){
            var g=this,n=new b(g.name,g.type),h,f,m,j,k;
            if(m=g.attributes){
                k=[];
                k.map={};
        
                for(h=0,f=m.length;h<f;h++){
                    j=m[h];
                    if(j.name!=="id"){
                        k[k.length]={
                            name:j.name,
                            value:j.value
                        };
                    
                        k.map[j.name]=j.value
                    }
                }
                n.attributes=k
            }
            n.value=g.value;
            n.shortEnded=g.shortEnded;
            return n
        },
        wrap:function(g){
            var f=this;
            f.parent.insert(g,f);
            g.append(f);
            return f
        },
        unwrap:function(){
            var f=this,h,g;
            for(h=f.firstChild;h;){
                g=h.next;
                f.insert(h,f,true);
                h=g
            }
            f.remove()
        },
        remove:function(){
            var f=this,h=f.parent,g=f.next,i=f.prev;
            if(h){
                if(h.firstChild===f){
                    h.firstChild=g;
                    if(g){
                        g.prev=null
                    }
                }else{
                    i.next=g
                }
                if(h.lastChild===f){
                    h.lastChild=i;
                    if(i){
                        i.next=null
                    }
                }else{
                    g.prev=i
                }
                f.parent=f.next=f.prev=null
            }
            return f
        },
        append:function(h){
            var f=this,g;
            if(h.parent){
                h.remove()
            }
            g=f.lastChild;
            if(g){
                g.next=h;
                h.prev=g;
                f.lastChild=h
            }else{
                f.lastChild=f.firstChild=h
            }
            h.parent=f;
            return h
        },
        insert:function(h,f,i){
            var g;
            if(h.parent){
                h.remove()
            }
            g=f.parent||this;
            if(i){
                if(f===g.firstChild){
                    g.firstChild=h
                }else{
                    f.prev.next=h
                }
                h.prev=f.prev;
                h.next=f;
                f.prev=h
            }else{
                if(f===g.lastChild){
                    g.lastChild=h
                }else{
                    f.next.prev=h
                }
                h.next=f.next;
                h.prev=f;
                f.next=h
            }
            h.parent=g;
            return h
        },
        getAll:function(g){
            var f=this,h,i=[];
            for(h=f.firstChild;h;h=a(h,f)){
                if(h.name===g){
                    i.push(h)
                }
            }
            return i
        },
        empty:function(){
            var g=this,f,h,j;
            if(g.firstChild){
                f=[];
                for(j=g.firstChild;j;j=a(j,g)){
                    f.push(j)
                }
                h=f.length;
                while(h--){
                    j=f[h];
                    j.parent=j.firstChild=j.lastChild=j.next=j.prev=null
                }
            }
            g.firstChild=g.lastChild=null;
            return g
        },
        isEmpty:function(k){
            var f=this,j=f.firstChild,h,g;
            if(j){
                do{
                    if(j.type===1){
                        if(j.attributes.map["data-mce-bogus"]){
                            continue
                        }
                        if(k[j.name]){
                            return false
                        }
                        h=j.attributes.length;
                        while(h--){
                            g=j.attributes[h].name;
                            if(g==="name"||g.indexOf("data-")===0){
                                return false
                            }
                        }
                    }
                    if((j.type===3&&!c.test(j.value))){
                        return false
                    }
                }while(j=a(j,f))
            }
            return true
        }
    });
    d.extend(b,{
        create:function(g,f){
            var i,h;
            i=new b(g,e[g]||1);
            if(f){
                for(h in f){
                    i.attr(h,f[h])
                }
            }
            return i
        }
    });
    d.html.Node=b
})(tinymce);
(function(b){
    var a=b.html.Node;
    b.html.DomParser=function(g,h){
        var f=this,e={},d=[],i={},c={};
        
        g=g||{};
        
        g.validate="validate" in g?g.validate:true;
        g.root_name=g.root_name||"body";
        f.schema=h=h||new b.html.Schema();
        function j(m){
            var o,p,x,v,z,n,q,l,t,u,k,s,y,r;
            s=b.makeMap("tr,td,th,tbody,thead,tfoot,table");
            k=h.getNonEmptyElements();
            for(o=0;o<m.length;o++){
                p=m[o];
                if(!p.parent){
                    continue
                }
                v=[p];
                for(x=p.parent;x&&!h.isValidChild(x.name,p.name)&&!s[x.name];x=x.parent){
                    v.push(x)
                }
                if(x&&v.length>1){
                    v.reverse();
                    z=n=f.filterNode(v[0].clone());
                    for(t=0;t<v.length-1;t++){
                        if(h.isValidChild(n.name,v[t].name)){
                            q=f.filterNode(v[t].clone());
                            n.append(q)
                        }else{
                            q=n
                        }
                        for(l=v[t].firstChild;l&&l!=v[t+1];){
                            r=l.next;
                            q.append(l);
                            l=r
                        }
                        n=q
                    }
                    if(!z.isEmpty(k)){
                        x.insert(z,v[0],true);
                        x.insert(p,z)
                    }else{
                        x.insert(p,v[0],true)
                    }
                    x=v[0];
                    if(x.isEmpty(k)||x.firstChild===x.lastChild&&x.firstChild.name==="br"){
                        x.empty().remove()
                    }
                }else{
                    if(p.parent){
                        if(p.name==="li"){
                            y=p.prev;
                            if(y&&(y.name==="ul"||y.name==="ul")){
                                y.append(p);
                                continue
                            }
                            y=p.next;
                            if(y&&(y.name==="ul"||y.name==="ul")){
                                y.insert(p,y.firstChild,true);
                                continue
                            }
                            p.wrap(f.filterNode(new a("ul",1)));
                            continue
                        }
                        if(h.isValidChild(p.parent.name,"div")&&h.isValidChild("div",p.name)){
                            p.wrap(f.filterNode(new a("div",1)))
                        }else{
                            if(p.name==="style"||p.name==="script"){
                                p.empty().remove()
                            }else{
                                p.unwrap()
                            }
                        }
                    }
                }
            }
        }
        f.filterNode=function(m){
            var l,k,n;
            if(k in e){
                n=i[k];
                if(n){
                    n.push(m)
                }else{
                    i[k]=[m]
                }
            }
            l=d.length;
            while(l--){
                k=d[l].name;
                if(k in m.attributes.map){
                    n=c[k];
                    if(n){
                        n.push(m)
                    }else{
                        c[k]=[m]
                    }
                }
            }
            return m
        };

        f.addNodeFilter=function(k,l){
            b.each(b.explode(k),function(m){
                var n=e[m];
                if(!n){
                    e[m]=n=[]
                }
                n.push(l)
            })
        };
    
        f.addAttributeFilter=function(k,l){
            b.each(b.explode(k),function(m){
                var n;
                for(n=0;n<d.length;n++){
                    if(d[n].name===m){
                        d[n].callbacks.push(l);
                        return
                    }
                }
                d.push({
                    name:m,
                    callbacks:[l]
                })
            })
        };

        f.parse=function(u,m){
            var n,F,z,y,B,A,v,q,D,I,x,o,C,H=[],s,k,r,p,t;
            m=m||{};
    
            i={};
    
            c={};
    
            o=b.extend(b.makeMap("script,style,head,html,body,title,meta,param"),h.getBlockElements());
            t=h.getNonEmptyElements();
            p=h.children;
            x=g.validate;
            r=h.getWhiteSpaceElements();
            C=/^[ \t\r\n]+/;
            s=/[ \t\r\n]+$/;
            k=/[ \t\r\n]+/g;
            function G(l,J){
                var K=new a(l,J),L;
                if(l in e){
                    L=i[l];
                    if(L){
                        L.push(K)
                    }else{
                        i[l]=[K]
                    }
                }
                return K
            }
            function E(K){
                var L,l,J;
                for(L=K.prev;L&&L.type===3;){
                    l=L.value.replace(s,"");
                    if(l.length>0){
                        L.value=l;
                        L=L.prev
                    }else{
                        J=L.prev;
                        L.remove();
                        L=J
                    }
                }
            }
            n=new b.html.SaxParser({
                validate:x,
                fix_self_closing:!x,
                cdata:function(l){
                    z.append(G("#cdata",4)).value=l
                },
                text:function(K,l){
                    var J;
                    if(!r[z.name]){
                        K=K.replace(k," ");
                        if(z.lastChild&&o[z.lastChild.name]){
                            K=K.replace(C,"")
                        }
                    }
                    if(K.length!==0){
                        J=G("#text",3);
                        J.raw=!!l;
                        z.append(J).value=K
                    }
                },
                comment:function(l){
                    z.append(G("#comment",8)).value=l
                },
                pi:function(l,J){
                    z.append(G(l,7)).value=J;
                    E(z)
                },
                doctype:function(J){
                    var l;
                    l=z.append(G("#doctype",10));
                    l.value=J;
                    E(z)
                },
                start:function(l,R,K){
                    var P,M,L,J,N,S,Q,O;
                    L=x?h.getElementRule(l):{};
    
                    if(L){
                        P=G(L.outputName||l,1);
                        P.attributes=R;
                        P.shortEnded=K;
                        z.append(P);
                        O=p[z.name];
                        if(O&&p[P.name]&&!O[P.name]){
                            H.push(P)
                        }
                        M=d.length;
                        while(M--){
                            N=d[M].name;
                            if(N in R.map){
                                D=c[N];
                                if(D){
                                    D.push(P)
                                }else{
                                    c[N]=[P]
                                }
                            }
                        }
                        if(o[l]){
                            E(P)
                        }
                        if(!K){
                            z=P
                        }
                    }
                },
                end:function(l){
                    var N,K,M,J,L;
                    K=x?h.getElementRule(l):{};
    
                    if(K){
                        if(o[l]){
                            if(!r[z.name]){
                                for(N=z.firstChild;N&&N.type===3;){
                                    M=N.value.replace(C,"");
                                    if(M.length>0){
                                        N.value=M;
                                        N=N.next
                                    }else{
                                        J=N.next;
                                        N.remove();
                                        N=J
                                    }
                                }
                                for(N=z.lastChild;N&&N.type===3;){
                                    M=N.value.replace(s,"");
                                    if(M.length>0){
                                        N.value=M;
                                        N=N.prev
                                    }else{
                                        J=N.prev;
                                        N.remove();
                                        N=J
                                    }
                                }
                            }
                            N=z.prev;
                            if(N&&N.type===3){
                                M=N.value.replace(C,"");
                                if(M.length>0){
                                    N.value=M
                                }else{
                                    N.remove()
                                }
                            }
                        }
                        if(K.removeEmpty||K.paddEmpty){
                            if(z.isEmpty(t)){
                                if(K.paddEmpty){
                                    z.empty().append(new a("#text","3")).value="\u00a0"
                                }else{
                                    if(!z.attributes.map.name){
                                        L=z.parent;
                                        z.empty().remove();
                                        z=L;
                                        return
                                    }
                                }
                            }
                        }
                        z=z.parent
                    }
                }
            },h);
            F=z=new a(g.root_name,11);
            n.parse(u);
            if(x){
                j(H)
            }
            for(I in i){
                D=e[I];
                y=i[I];
                v=y.length;
                while(v--){
                    if(!y[v].parent){
                        y.splice(v,1)
                    }
                }
                for(B=0,A=D.length;B<A;B++){
                    D[B](y,I,m)
                }
            }
            for(B=0,A=d.length;B<A;B++){
                D=d[B];
                if(D.name in c){
                    y=c[D.name];
                    v=y.length;
                    while(v--){
                        if(!y[v].parent){
                            y.splice(v,1)
                        }
                    }
                    for(v=0,q=D.callbacks.length;v<q;v++){
                        D.callbacks[v](y,D.name,m)
                    }
                }
            }
            return F
        };

        if(g.remove_trailing_brs){
            f.addNodeFilter("br",function(n,m){
                var r,q=n.length,o,u=h.getBlockElements(),k=h.getNonEmptyElements(),s,p,t;
                for(r=0;r<q;r++){
                    o=n[r];
                    s=o.parent;
                    if(u[o.parent.name]&&o===s.lastChild){
                        p=o.prev;
                        while(p){
                            t=p.name;
                            if(t!=="span"||p.attr("data-mce-type")!=="bookmark"){
                                if(t!=="br"){
                                    break
                                }
                                if(t==="br"){
                                    o=null;
                                    break
                                }
                            }
                            p=p.prev
                        }
                        if(o){
                            o.remove();
                            if(s.isEmpty(k)){
                                elementRule=h.getElementRule(s.name);
                                if(elementRule.removeEmpty){
                                    s.remove()
                                }else{
                                    if(elementRule.paddEmpty){
                                        s.empty().append(new b.html.Node("#text",3)).value="\u00a0"
                                    }
                                }
                            }
                        }
                    }
                }
            })
        }
    }
})(tinymce);
tinymce.html.Writer=function(e){
    var c=[],a,b,d,f,g;
    e=e||{};
    
    a=e.indent;
    b=tinymce.makeMap(e.indent_before||"");
    d=tinymce.makeMap(e.indent_after||"");
    f=tinymce.html.Entities.getEncodeFunc(e.entity_encoding||"raw",e.entities);
    g=e.element_format=="html";
    return{
        start:function(m,k,p){
            var n,j,h,o;
            if(a&&b[m]&&c.length>0){
                o=c[c.length-1];
                if(o.length>0&&o!=="\n"){
                    c.push("\n")
                }
            }
            c.push("<",m);
            if(k){
                for(n=0,j=k.length;n<j;n++){
                    h=k[n];
                    c.push(" ",h.name,'="',f(h.value,true),'"')
                }
            }
            if(!p||g){
                c[c.length]=">"
            }else{
                c[c.length]=" />"
            }
            if(p&&a&&d[m]&&c.length>0){
                o=c[c.length-1];
                if(o.length>0&&o!=="\n"){
                    c.push("\n")
                }
            }
        },
        end:function(h){
            var i;
            c.push("</",h,">");
            if(a&&d[h]&&c.length>0){
                i=c[c.length-1];
                if(i.length>0&&i!=="\n"){
                    c.push("\n")
                }
            }
        },
        text:function(i,h){
            if(i.length>0){
                c[c.length]=h?i:f(i)
            }
        },
        cdata:function(h){
            c.push("<![CDATA[",h,"]]>")
        },
        comment:function(h){
            c.push("<!--",h,"-->")
        },
        pi:function(h,i){
            if(i){
                c.push("<?",h," ",i,"?>")
            }else{
                c.push("<?",h,"?>")
            }
            if(a){
                c.push("\n")
            }
        },
        doctype:function(h){
            c.push("<!DOCTYPE",h,">",a?"\n":"")
        },
        reset:function(){
            c.length=0
        },
        getContent:function(){
            return c.join("").replace(/\n$/,"")
        }
    }
};
(function(a){
    a.html.Serializer=function(c,d){
        var b=this,e=new a.html.Writer(c);
        c=c||{};
        
        c.validate="validate" in c?c.validate:true;
        b.schema=d=d||new a.html.Schema();
        b.writer=e;
        b.serialize=function(h){
            var g,i;
            i=c.validate;
            g={
                3:function(k,j){
                    e.text(k.value,k.raw)
                },
                8:function(j){
                    e.comment(j.value)
                },
                7:function(j){
                    e.pi(j.name,j.value)
                },
                10:function(j){
                    e.doctype(j.value)
                },
                4:function(j){
                    e.cdata(j.value)
                },
                11:function(j){
                    if((j=j.firstChild)){
                        do{
                            f(j)
                        }while(j=j.next)
                    }
                }
            };
        
            e.reset();
            function f(k){
                var t=g[k.type],j,o,s,r,p,u,n,m,q;
                if(!t){
                    j=k.name;
                    o=k.shortEnded;
                    s=k.attributes;
                    if(i&&s&&s.length>1){
                        u=[];
                        u.map={};
                
                        q=d.getElementRule(k.name);
                        for(n=0,m=q.attributesOrder.length;n<m;n++){
                            r=q.attributesOrder[n];
                            if(r in s.map){
                                p=s.map[r];
                                u.map[r]=p;
                                u.push({
                                    name:r,
                                    value:p
                                })
                            }
                        }
                        for(n=0,m=s.length;n<m;n++){
                            r=s[n].name;
                            if(!(r in u.map)){
                                p=s.map[r];
                                u.map[r]=p;
                                u.push({
                                    name:r,
                                    value:p
                                })
                            }
                        }
                        s=u
                    }
                    e.start(k.name,s,o);
                    if(!o){
                        if((k=k.firstChild)){
                            do{
                                f(k)
                            }while(k=k.next)
                        }
                        e.end(j)
                    }
                }else{
                    t(k)
                }
            }
            if(h.type==1&&!c.inner){
                f(h)
            }else{
                g[11](h)
            }
            return e.getContent()
        }
    }
})(tinymce);
(function(h){
    var f=h.each,e=h.is,d=h.isWebKit,b=h.isIE,c=h.html.Entities,a=/^([a-z0-9],?)+$/i,g=h.html.Schema.blockElementsMap,i=/^[ \t\r\n]*$/;
    h.create("tinymce.dom.DOMUtils",{
        doc:null,
        root:null,
        files:null,
        pixelStyles:/^(top|left|bottom|right|width|height|borderWidth)$/,
        props:{
            "for":"htmlFor",
            "class":"className",
            className:"className",
            checked:"checked",
            disabled:"disabled",
            maxlength:"maxLength",
            readonly:"readOnly",
            selected:"selected",
            value:"value",
            id:"id",
            name:"name",
            type:"type"
        },
        DOMUtils:function(n,l){
            var k=this,j;
            k.doc=n;
            k.win=window;
            k.files={};
            
            k.cssFlicker=false;
            k.counter=0;
            k.stdMode=!h.isIE||n.documentMode>=8;
            k.boxModel=!h.isIE||n.compatMode=="CSS1Compat"||k.stdMode;
            k.hasOuterHTML="outerHTML" in n.createElement("a");
            k.settings=l=h.extend({
                keep_values:false,
                hex_colors:1
            },l);
            k.schema=l.schema;
            k.styles=new h.html.Styles({
                url_converter:l.url_converter,
                url_converter_scope:l.url_converter_scope
            },l.schema);
            if(h.isIE6){
                try{
                    n.execCommand("BackgroundImageCache",false,true)
                }catch(m){
                    k.cssFlicker=true
                }
            }
            if(b){
                ("abbr article aside audio canvas details figcaption figure footer header hgroup mark menu meter nav output progress section summary time video").replace(/\w+/g,function(o){
                    n.createElement(o)
                })
            }
            h.addUnload(k.destroy,k)
        },
        getRoot:function(){
            var j=this,k=j.settings;
            return(k&&j.get(k.root_element))||j.doc.body
        },
        getViewPort:function(k){
            var l,j;
            k=!k?this.win:k;
            l=k.document;
            j=this.boxModel?l.documentElement:l.body;
            return{
                x:k.pageXOffset||j.scrollLeft,
                y:k.pageYOffset||j.scrollTop,
                w:k.innerWidth||j.clientWidth,
                h:k.innerHeight||j.clientHeight
            }
        },
        getRect:function(m){
            var l,j=this,k;
            m=j.get(m);
            l=j.getPos(m);
            k=j.getSize(m);
            return{
                x:l.x,
                y:l.y,
                w:k.w,
                h:k.h
            }
        },
        getSize:function(m){
            var k=this,j,l;
            m=k.get(m);
            j=k.getStyle(m,"width");
            l=k.getStyle(m,"height");
            if(j.indexOf("px")===-1){
                j=0
            }
            if(l.indexOf("px")===-1){
                l=0
            }
            return{
                w:parseInt(j)||m.offsetWidth||m.clientWidth,
                h:parseInt(l)||m.offsetHeight||m.clientHeight
            }
        },
        getParent:function(l,k,j){
            return this.getParents(l,k,j,false)
        },
        getParents:function(u,p,l,s){
            var k=this,j,m=k.settings,q=[];
            u=k.get(u);
            s=s===undefined;
            if(m.strict_root){
                l=l||k.getRoot()
            }
            if(e(p,"string")){
                j=p;
                if(p==="*"){
                    p=function(o){
                        return o.nodeType==1
                    }
                }else{
                    p=function(o){
                        return k.is(o,j)
                    }
                }
            }while(u){
                if(u==l||!u.nodeType||u.nodeType===9){
                    break
                }
                if(!p||p(u)){
                    if(s){
                        q.push(u)
                    }else{
                        return u
                    }
                }
                u=u.parentNode
            }
            return s?q:null
        },
        get:function(j){
            var k;
            if(j&&this.doc&&typeof(j)=="string"){
                k=j;
                j=this.doc.getElementById(j);
                if(j&&j.id!==k){
                    return this.doc.getElementsByName(k)[1]
                }
            }
            return j
        },
        getNext:function(k,j){
            return this._findSib(k,j,"nextSibling")
        },
        getPrev:function(k,j){
            return this._findSib(k,j,"previousSibling")
        },
        select:function(l,k){
            var j=this;
            return h.dom.Sizzle(l,j.get(k)||j.get(j.settings.root_element)||j.doc,[])
        },
        is:function(l,j){
            var k;
            if(l.length===undefined){
                if(j==="*"){
                    return l.nodeType==1
                }
                if(a.test(j)){
                    j=j.toLowerCase().split(/,/);
                    l=l.nodeName.toLowerCase();
                    for(k=j.length-1;k>=0;k--){
                        if(j[k]==l){
                            return true
                        }
                    }
                    return false
                }
            }
            return h.dom.Sizzle.matches(j,l.nodeType?[l]:l).length>0
        },
        add:function(m,q,j,l,o){
            var k=this;
            return this.run(m,function(s){
                var r,n;
                r=e(q,"string")?k.doc.createElement(q):q;
                k.setAttribs(r,j);
                if(l){
                    if(l.nodeType){
                        r.appendChild(l)
                    }else{
                        k.setHTML(r,l)
                    }
                }
                return !o?s.appendChild(r):r
            })
        },
        create:function(l,j,k){
            return this.add(this.doc.createElement(l),l,j,k,1)
        },
        createHTML:function(r,j,p){
            var q="",m=this,l;
            q+="<"+r;
            for(l in j){
                if(j.hasOwnProperty(l)){
                    q+=" "+l+'="'+m.encode(j[l])+'"'
                }
            }
            if(typeof(p)!="undefined"){
                return q+">"+p+"</"+r+">"
            }
            return q+" />"
        },
        remove:function(j,k){
            return this.run(j,function(m){
                var n,l=m.parentNode;
                if(!l){
                    return null
                }
                if(k){
                    while(n=m.firstChild){
                        if(!h.isIE||n.nodeType!==3||n.nodeValue){
                            l.insertBefore(n,m)
                        }else{
                            m.removeChild(n)
                        }
                    }
                }
                return l.removeChild(m)
            })
        },
        setStyle:function(m,j,k){
            var l=this;
            return l.run(m,function(p){
                var o,n;
                o=p.style;
                j=j.replace(/-(\D)/g,function(r,q){
                    return q.toUpperCase()
                });
                if(l.pixelStyles.test(j)&&(h.is(k,"number")||/^[\-0-9\.]+$/.test(k))){
                    k+="px"
                }
                switch(j){
                    case"opacity":
                        if(b){
                            o.filter=k===""?"":"alpha(opacity="+(k*100)+")";
                            if(!m.currentStyle||!m.currentStyle.hasLayout){
                                o.display="inline-block"
                            }
                        }
                        o[j]=o["-moz-opacity"]=o["-khtml-opacity"]=k||"";
                        break;
                    case"float":
                        b?o.styleFloat=k:o.cssFloat=k;
                        break;
                    default:
                        o[j]=k||""
                }
                if(l.settings.update_styles){
                    l.setAttrib(p,"data-mce-style")
                }
            })
        },
        getStyle:function(m,j,l){
            m=this.get(m);
            if(!m){
                return
            }
            if(this.doc.defaultView&&l){
                j=j.replace(/[A-Z]/g,function(n){
                    return"-"+n
                });
                try{
                    return this.doc.defaultView.getComputedStyle(m,null).getPropertyValue(j)
                }catch(k){
                    return null
                }
            }
            j=j.replace(/-(\D)/g,function(o,n){
                return n.toUpperCase()
            });
            if(j=="float"){
                j=b?"styleFloat":"cssFloat"
            }
            if(m.currentStyle&&l){
                return m.currentStyle[j]
            }
            return m.style?m.style[j]:undefined
        },
        setStyles:function(m,n){
            var k=this,l=k.settings,j;
            j=l.update_styles;
            l.update_styles=0;
            f(n,function(o,p){
                k.setStyle(m,p,o)
            });
            l.update_styles=j;
            if(l.update_styles){
                k.setAttrib(m,l.cssText)
            }
        },
        removeAllAttribs:function(j){
            return this.run(j,function(m){
                var l,k=m.attributes;
                for(l=k.length-1;l>=0;l--){
                    m.removeAttributeNode(k.item(l))
                }
            })
        },
        setAttrib:function(l,m,j){
            var k=this;
            if(!l||!m){
                return
            }
            if(k.settings.strict){
                m=m.toLowerCase()
            }
            return this.run(l,function(o){
                var n=k.settings;
                switch(m){
                    case"style":
                        if(!e(j,"string")){
                            f(j,function(p,q){
                                k.setStyle(o,q,p)
                            });
                            return
                        }
                        if(n.keep_values){
                            if(j&&!k._isRes(j)){
                                o.setAttribute("data-mce-style",j,2)
                            }else{
                                o.removeAttribute("data-mce-style",2)
                            }
                        }
                        o.style.cssText=j;
                        break;
                    case"class":
                        o.className=j||"";
                        break;
                    case"src":case"href":
                        if(n.keep_values){
                            if(n.url_converter){
                                j=n.url_converter.call(n.url_converter_scope||k,j,m,o)
                            }
                            k.setAttrib(o,"data-mce-"+m,j,2)
                        }
                        break;
                    case"shape":
                        o.setAttribute("data-mce-style",j);
                        break
                }
                if(e(j)&&j!==null&&j.length!==0){
                    o.setAttribute(m,""+j,2)
                }else{
                    o.removeAttribute(m,2)
                }
            })
        },
        setAttribs:function(k,l){
            var j=this;
            return this.run(k,function(m){
                f(l,function(o,p){
                    j.setAttrib(m,p,o)
                })
            })
        },
        getAttrib:function(m,o,l){
            var j,k=this;
            m=k.get(m);
            if(!m||m.nodeType!==1){
                return false
            }
            if(!e(l)){
                l=""
            }
            if(/^(src|href|style|coords|shape)$/.test(o)){
                j=m.getAttribute("data-mce-"+o);
                if(j){
                    return j
                }
            }
            if(b&&k.props[o]){
                j=m[k.props[o]];
                j=j&&j.nodeValue?j.nodeValue:j
            }
            if(!j){
                j=m.getAttribute(o,2)
            }
            if(/^(checked|compact|declare|defer|disabled|ismap|multiple|nohref|noshade|nowrap|readonly|selected)$/.test(o)){
                if(m[k.props[o]]===true&&j===""){
                    return o
                }
                return j?o:""
            }
            if(m.nodeName==="FORM"&&m.getAttributeNode(o)){
                return m.getAttributeNode(o).nodeValue
            }
            if(o==="style"){
                j=j||m.style.cssText;
                if(j){
                    j=k.serializeStyle(k.parseStyle(j),m.nodeName);
                    if(k.settings.keep_values&&!k._isRes(j)){
                        m.setAttribute("data-mce-style",j)
                    }
                }
            }
            if(d&&o==="class"&&j){
                j=j.replace(/(apple|webkit)\-[a-z\-]+/gi,"")
            }
            if(b){
                switch(o){
                    case"rowspan":case"colspan":
                        if(j===1){
                            j=""
                        }
                        break;
                    case"size":
                        if(j==="+0"||j===20||j===0){
                            j=""
                        }
                        break;
                    case"width":case"height":case"vspace":case"checked":case"disabled":case"readonly":
                        if(j===0){
                            j=""
                        }
                        break;
                    case"hspace":
                        if(j===-1){
                            j=""
                        }
                        break;
                    case"maxlength":case"tabindex":
                        if(j===32768||j===2147483647||j==="32768"){
                            j=""
                        }
                        break;
                    case"multiple":case"compact":case"noshade":case"nowrap":
                        if(j===65535){
                            return o
                        }
                        return l;
                    case"shape":
                        j=j.toLowerCase();
                        break;
                    default:
                        if(o.indexOf("on")===0&&j){
                            j=h._replace(/^function\s+\w+\(\)\s+\{\s+(.*)\s+\}$/,"$1",""+j)
                        }
                }
            }
            return(j!==undefined&&j!==null&&j!=="")?""+j:l
        },
        getPos:function(s,m){
            var k=this,j=0,q=0,o,p=k.doc,l;
            s=k.get(s);
            m=m||p.body;
            if(s){
                if(b&&!k.stdMode){
                    s=s.getBoundingClientRect();
                    o=k.boxModel?p.documentElement:p.body;
                    j=k.getStyle(k.select("html")[0],"borderWidth");
                    j=(j=="medium"||k.boxModel&&!k.isIE6)&&2||j;
                    return{
                        x:s.left+o.scrollLeft-j,
                        y:s.top+o.scrollTop-j
                    }
                }
                l=s;
                while(l&&l!=m&&l.nodeType){
                    j+=l.offsetLeft||0;
                    q+=l.offsetTop||0;
                    l=l.offsetParent
                }
                l=s.parentNode;
                while(l&&l!=m&&l.nodeType){
                    j-=l.scrollLeft||0;
                    q-=l.scrollTop||0;
                    l=l.parentNode
                }
            }
            return{
                x:j,
                y:q
            }
        },
        parseStyle:function(j){
            return this.styles.parse(j)
        },
        serializeStyle:function(k,j){
            return this.styles.serialize(k,j)
        },
        loadCSS:function(j){
            var l=this,m=l.doc,k;
            if(!j){
                j=""
            }
            k=l.select("head")[0];
            f(j.split(","),function(n){
                var o;
                if(l.files[n]){
                    return
                }
                l.files[n]=true;
                o=l.create("link",{
                    rel:"stylesheet",
                    href:h._addVer(n)
                });
                if(b&&m.documentMode&&m.recalc){
                    o.onload=function(){
                        if(m.recalc){
                            m.recalc()
                        }
                        o.onload=null
                    }
                }
                k.appendChild(o)
            })
        },
        addClass:function(j,k){
            return this.run(j,function(l){
                var m;
                if(!k){
                    return 0
                }
                if(this.hasClass(l,k)){
                    return l.className
                }
                m=this.removeClass(l,k);
                return l.className=(m!=""?(m+" "):"")+k
            })
        },
        removeClass:function(l,m){
            var j=this,k;
            return j.run(l,function(o){
                var n;
                if(j.hasClass(o,m)){
                    if(!k){
                        k=new RegExp("(^|\\s+)"+m+"(\\s+|$)","g")
                    }
                    n=o.className.replace(k," ");
                    n=h.trim(n!=" "?n:"");
                    o.className=n;
                    if(!n){
                        o.removeAttribute("class");
                        o.removeAttribute("className")
                    }
                    return n
                }
                return o.className
            })
        },
        hasClass:function(k,j){
            k=this.get(k);
            if(!k||!j){
                return false
            }
            return(" "+k.className+" ").indexOf(" "+j+" ")!==-1
        },
        show:function(j){
            return this.setStyle(j,"display","block")
        },
        hide:function(j){
            return this.setStyle(j,"display","none")
        },
        isHidden:function(j){
            j=this.get(j);
            return !j||j.style.display=="none"||this.getStyle(j,"display")=="none"
        },
        uniqueId:function(j){
            return(!j?"mce_":j)+(this.counter++)
        },
        setHTML:function(l,k){
            var j=this;
            return j.run(l,function(n){
                if(b){
                    while(n.firstChild){
                        n.removeChild(n.firstChild)
                    }
                    try{
                        n.innerHTML="<br />"+k;
                        n.removeChild(n.firstChild)
                    }catch(m){
                        n=j.create("div");
                        n.innerHTML="<br />"+k;
                        f(n.childNodes,function(p,o){
                            if(o){
                                n.appendChild(p)
                            }
                        })
                    }
                }else{
                    n.innerHTML=k
                }
                return k
            })
        },
        getOuterHTML:function(l){
            var k,j=this;
            l=j.get(l);
            if(!l){
                return null
            }
            if(l.nodeType===1&&j.hasOuterHTML){
                return l.outerHTML
            }
            k=(l.ownerDocument||j.doc).createElement("body");
            k.appendChild(l.cloneNode(true));
            return k.innerHTML
        },
        setOuterHTML:function(m,k,n){
            var j=this;
            function l(p,o,r){
                var s,q;
                q=r.createElement("body");
                q.innerHTML=o;
                s=q.lastChild;
                while(s){
                    j.insertAfter(s.cloneNode(true),p);
                    s=s.previousSibling
                }
                j.remove(p)
            }
            return this.run(m,function(p){
                p=j.get(p);
                if(p.nodeType==1){
                    n=n||p.ownerDocument||j.doc;
                    if(b){
                        try{
                            if(b&&p.nodeType==1){
                                p.outerHTML=k
                            }else{
                                l(p,k,n)
                            }
                        }catch(o){
                            l(p,k,n)
                        }
                    }else{
                        l(p,k,n)
                    }
                }
            })
        },
        decode:c.decode,
        encode:c.encodeAllRaw,
        insertAfter:function(j,k){
            k=this.get(k);
            return this.run(j,function(m){
                var l,n;
                l=k.parentNode;
                n=k.nextSibling;
                if(n){
                    l.insertBefore(m,n)
                }else{
                    l.appendChild(m)
                }
                return m
            })
        },
        isBlock:function(k){
            var j=k.nodeType;
            if(j){
                return !!(j===1&&g[k.nodeName])
            }
            return !!g[k]
        },
        replace:function(p,m,j){
            var l=this;
            if(e(m,"array")){
                p=p.cloneNode(true)
            }
            return l.run(m,function(k){
                if(j){
                    f(h.grep(k.childNodes),function(n){
                        p.appendChild(n)
                    })
                }
                return k.parentNode.replaceChild(p,k)
            })
        },
        rename:function(m,j){
            var l=this,k;
            if(m.nodeName!=j.toUpperCase()){
                k=l.create(j);
                f(l.getAttribs(m),function(n){
                    l.setAttrib(k,n.nodeName,l.getAttrib(m,n.nodeName))
                });
                l.replace(k,m,1)
            }
            return k||m
        },
        findCommonAncestor:function(l,j){
            var m=l,k;
            while(m){
                k=j;
                while(k&&m!=k){
                    k=k.parentNode
                }
                if(m==k){
                    break
                }
                m=m.parentNode
            }
            if(!m&&l.ownerDocument){
                return l.ownerDocument.documentElement
            }
            return m
        },
        toHex:function(j){
            var l=/^\s*rgb\s*?\(\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?\)\s*$/i.exec(j);
            function k(m){
                m=parseInt(m).toString(16);
                return m.length>1?m:"0"+m
            }
            if(l){
                j="#"+k(l[1])+k(l[2])+k(l[3]);
                return j
            }
            return j
        },
        getClasses:function(){
            var n=this,j=[],m,o={},p=n.settings.class_filter,l;
            if(n.classes){
                return n.classes
            }
            function q(r){
                f(r.imports,function(s){
                    q(s)
                });
                f(r.cssRules||r.rules,function(s){
                    switch(s.type||1){
                        case 1:
                            if(s.selectorText){
                                f(s.selectorText.split(","),function(t){
                                    t=t.replace(/^\s*|\s*$|^\s\./g,"");
                                    if(/\.mce/.test(t)||!/\.[\w\-]+$/.test(t)){
                                        return
                                    }
                                    l=t;
                                    t=h._replace(/.*\.([a-z0-9_\-]+).*/i,"$1",t);
                                    if(p&&!(t=p(t,l))){
                                        return
                                    }
                                    if(!o[t]){
                                        j.push({
                                            "class":t
                                        });
                                        o[t]=1
                                    }
                                })
                            }
                            break;
                        case 3:
                            q(s.styleSheet);
                            break
                    }
                })
            }
            try{
                f(n.doc.styleSheets,q)
            }catch(k){}
            if(j.length>0){
                n.classes=j
            }
            return j
        },
        run:function(m,l,k){
            var j=this,n;
            if(j.doc&&typeof(m)==="string"){
                m=j.get(m)
            }
            if(!m){
                return false
            }
            k=k||this;
            if(!m.nodeType&&(m.length||m.length===0)){
                n=[];
                f(m,function(p,o){
                    if(p){
                        if(typeof(p)=="string"){
                            p=j.doc.getElementById(p)
                        }
                        n.push(l.call(k,p,o))
                    }
                });
                return n
            }
            return l.call(k,m)
        },
        getAttribs:function(k){
            var j;
            k=this.get(k);
            if(!k){
                return[]
            }
            if(b){
                j=[];
                if(k.nodeName=="OBJECT"){
                    return k.attributes
                }
                if(k.nodeName==="OPTION"&&this.getAttrib(k,"selected")){
                    j.push({
                        specified:1,
                        nodeName:"selected"
                    })
                }
                k.cloneNode(false).outerHTML.replace(/<\/?[\w:\-]+ ?|=[\"][^\"]+\"|=\'[^\']+\'|=[\w\-]+|>/gi,"").replace(/[\w:\-]+/gi,function(l){
                    j.push({
                        specified:1,
                        nodeName:l
                    })
                });
                return j
            }
            return k.attributes
        },
        isEmpty:function(o,p){
            var k=this,m,j,n,q,l;
            o=o.firstChild;
            if(o){
                q=new h.dom.TreeWalker(o);
                p=p||k.schema?k.schema.getNonEmptyElements():null;
                do{
                    n=o.nodeType;
                    if(n===1){
                        if(o.getAttribute("data-mce-bogus")){
                            continue
                        }
                        if(p&&p[o.nodeName.toLowerCase()]){
                            return false
                        }
                        j=k.getAttribs(o);
                        m=o.attributes.length;
                        while(m--){
                            l=o.attributes[m].nodeName;
                            if(l==="name"||l.indexOf("data-")===0){
                                return false
                            }
                        }
                    }
                    if((n===3&&!i.test(o.nodeValue))){
                        return false
                    }
                }while(o=q.next())
            }
            return true
        },
        destroy:function(k){
            var j=this;
            if(j.events){
                j.events.destroy()
            }
            j.win=j.doc=j.root=j.events=null;
            if(!k){
                h.removeUnload(j.destroy)
            }
        },
        createRng:function(){
            var j=this.doc;
            return j.createRange?j.createRange():new h.dom.Range(this)
        },
        nodeIndex:function(o,p){
            var j=0,m,n,l,k;
            if(o){
                for(m=o.nodeType,o=o.previousSibling,n=o;o;o=o.previousSibling){
                    l=o.nodeType;
                    if(p&&l==3){
                        k=false;
                        try{
                            k=o.nodeValue.length
                        }catch(q){}
                        if(l==m||!k){
                            continue
                        }
                    }
                    j++;
                    m=l
                }
            }
            return j
        },
        split:function(n,m,q){
            var s=this,j=s.createRng(),o,l,p;
            function k(v){
                var t,r=v.childNodes,u=v.nodeType;
                if(u==1&&v.getAttribute("data-mce-type")=="bookmark"){
                    return
                }
                for(t=r.length-1;t>=0;t--){
                    k(r[t])
                }
                if(u!=9){
                    if(u==3&&v.nodeValue.length>0){
                        if(!s.isBlock(v.parentNode)||h.trim(v.nodeValue).length>0){
                            return
                        }
                    }else{
                        if(u==1){
                            r=v.childNodes;
                            if(r.length==1&&r[0]&&r[0].nodeType==1&&r[0].getAttribute("data-mce-type")=="bookmark"){
                                v.parentNode.insertBefore(r[0],v)
                            }
                            if(r.length||/^(br|hr|input|img)$/i.test(v.nodeName)){
                                return
                            }
                        }
                    }
                    s.remove(v)
                }
                return v
            }
            if(n&&m){
                j.setStart(n.parentNode,s.nodeIndex(n));
                j.setEnd(m.parentNode,s.nodeIndex(m));
                o=j.extractContents();
                j=s.createRng();
                j.setStart(m.parentNode,s.nodeIndex(m)+1);
                j.setEnd(n.parentNode,s.nodeIndex(n)+1);
                l=j.extractContents();
                p=n.parentNode;
                p.insertBefore(k(o),n);
                if(q){
                    p.replaceChild(q,m)
                }else{
                    p.insertBefore(m,n)
                }
                p.insertBefore(k(l),n);
                s.remove(n);
                return q||m
            }
        },
        bind:function(n,j,m,l){
            var k=this;
            if(!k.events){
                k.events=new h.dom.EventUtils()
            }
            return k.events.add(n,j,m,l||this)
        },
        unbind:function(m,j,l){
            var k=this;
            if(!k.events){
                k.events=new h.dom.EventUtils()
            }
            return k.events.remove(m,j,l)
        },
        _findSib:function(m,j,k){
            var l=this,n=j;
            if(m){
                if(e(n,"string")){
                    n=function(o){
                        return l.is(o,j)
                    }
                }
                for(m=m[k];m;m=m[k]){
                    if(n(m)){
                        return m
                    }
                }
            }
            return null
        },
        _isRes:function(j){
            return/^(top|left|bottom|right|width|height)/i.test(j)||/;\s*(top|left|bottom|right|width|height)/i.test(j)
        }
    });
    h.DOM=new h.dom.DOMUtils(document,{
        process_html:0
    })
})(tinymce);
(function(a){
    function b(c){
        var N=this,e=c.doc,S=0,E=1,j=2,D=true,R=false,U="startOffset",h="startContainer",P="endContainer",z="endOffset",k=tinymce.extend,n=c.nodeIndex;
        k(N,{
            startContainer:e,
            startOffset:0,
            endContainer:e,
            endOffset:0,
            collapsed:D,
            commonAncestorContainer:e,
            START_TO_START:0,
            START_TO_END:1,
            END_TO_END:2,
            END_TO_START:3,
            setStart:q,
            setEnd:s,
            setStartBefore:g,
            setStartAfter:I,
            setEndBefore:J,
            setEndAfter:u,
            collapse:A,
            selectNode:x,
            selectNodeContents:F,
            compareBoundaryPoints:v,
            deleteContents:p,
            extractContents:H,
            cloneContents:d,
            insertNode:C,
            surroundContents:M,
            cloneRange:K
        });
        function q(V,t){
            B(D,V,t)
        }
        function s(V,t){
            B(R,V,t)
        }
        function g(t){
            q(t.parentNode,n(t))
        }
        function I(t){
            q(t.parentNode,n(t)+1)
        }
        function J(t){
            s(t.parentNode,n(t))
        }
        function u(t){
            s(t.parentNode,n(t)+1)
        }
        function A(t){
            if(t){
                N[P]=N[h];
                N[z]=N[U]
            }else{
                N[h]=N[P];
                N[U]=N[z]
            }
            N.collapsed=D
        }
        function x(t){
            g(t);
            u(t)
        }
        function F(t){
            q(t,0);
            s(t,t.nodeType===1?t.childNodes.length:t.nodeValue.length)
        }
        function v(Y,t){
            var ab=N[h],W=N[U],aa=N[P],V=N[z],Z=t.startContainer,ad=t.startOffset,X=t.endContainer,ac=t.endOffset;
            if(Y===0){
                return G(ab,W,Z,ad)
            }
            if(Y===1){
                return G(aa,V,Z,ad)
            }
            if(Y===2){
                return G(aa,V,X,ac)
            }
            if(Y===3){
                return G(ab,W,X,ac)
            }
        }
        function p(){
            m(j)
        }
        function H(){
            return m(S)
        }
        function d(){
            return m(E)
        }
        function C(Y){
            var V=this[h],t=this[U],X,W;
            if((V.nodeType===3||V.nodeType===4)&&V.nodeValue){
                if(!t){
                    V.parentNode.insertBefore(Y,V)
                }else{
                    if(t>=V.nodeValue.length){
                        c.insertAfter(Y,V)
                    }else{
                        X=V.splitText(t);
                        V.parentNode.insertBefore(Y,X)
                    }
                }
            }else{
                if(V.childNodes.length>0){
                    W=V.childNodes[t]
                }
                if(W){
                    V.insertBefore(Y,W)
                }else{
                    V.appendChild(Y)
                }
            }
        }
        function M(V){
            var t=N.extractContents();
            N.insertNode(V);
            V.appendChild(t);
            N.selectNode(V)
        }
        function K(){
            return k(new b(c),{
                startContainer:N[h],
                startOffset:N[U],
                endContainer:N[P],
                endOffset:N[z],
                collapsed:N.collapsed,
                commonAncestorContainer:N.commonAncestorContainer
            })
        }
        function O(t,V){
            var W;
            if(t.nodeType==3){
                return t
            }
            if(V<0){
                return t
            }
            W=t.firstChild;
            while(W&&V>0){
                --V;
                W=W.nextSibling
            }
            if(W){
                return W
            }
            return t
        }
        function l(){
            return(N[h]==N[P]&&N[U]==N[z])
        }
        function G(X,Z,V,Y){
            var aa,W,t,ab,ad,ac;
            if(X==V){
                if(Z==Y){
                    return 0
                }
                if(Z<Y){
                    return -1
                }
                return 1
            }
            aa=V;
            while(aa&&aa.parentNode!=X){
                aa=aa.parentNode
            }
            if(aa){
                W=0;
                t=X.firstChild;
                while(t!=aa&&W<Z){
                    W++;
                    t=t.nextSibling
                }
                if(Z<=W){
                    return -1
                }
                return 1
            }
            aa=X;
            while(aa&&aa.parentNode!=V){
                aa=aa.parentNode
            }
            if(aa){
                W=0;
                t=V.firstChild;
                while(t!=aa&&W<Y){
                    W++;
                    t=t.nextSibling
                }
                if(W<Y){
                    return -1
                }
                return 1
            }
            ab=c.findCommonAncestor(X,V);
            ad=X;
            while(ad&&ad.parentNode!=ab){
                ad=ad.parentNode
            }
            if(!ad){
                ad=ab
            }
            ac=V;
            while(ac&&ac.parentNode!=ab){
                ac=ac.parentNode
            }
            if(!ac){
                ac=ab
            }
            if(ad==ac){
                return 0
            }
            t=ab.firstChild;
            while(t){
                if(t==ad){
                    return -1
                }
                if(t==ac){
                    return 1
                }
                t=t.nextSibling
            }
        }
        function B(V,Y,X){
            var t,W;
            if(V){
                N[h]=Y;
                N[U]=X
            }else{
                N[P]=Y;
                N[z]=X
            }
            t=N[P];
            while(t.parentNode){
                t=t.parentNode
            }
            W=N[h];
            while(W.parentNode){
                W=W.parentNode
            }
            if(W==t){
                if(G(N[h],N[U],N[P],N[z])>0){
                    N.collapse(V)
                }
            }else{
                N.collapse(V)
            }
            N.collapsed=l();
            N.commonAncestorContainer=c.findCommonAncestor(N[h],N[P])
        }
        function m(ab){
            var aa,X=0,ad=0,V,Z,W,Y,t,ac;
            if(N[h]==N[P]){
                return f(ab)
            }
            for(aa=N[P],V=aa.parentNode;V;aa=V,V=V.parentNode){
                if(V==N[h]){
                    return r(aa,ab)
                }
                ++X
            }
            for(aa=N[h],V=aa.parentNode;V;aa=V,V=V.parentNode){
                if(V==N[P]){
                    return T(aa,ab)
                }
                ++ad
            }
            Z=ad-X;
            W=N[h];
            while(Z>0){
                W=W.parentNode;
                Z--
            }
            Y=N[P];
            while(Z<0){
                Y=Y.parentNode;
                Z++
            }
            for(t=W.parentNode,ac=Y.parentNode;t!=ac;t=t.parentNode,ac=ac.parentNode){
                W=t;
                Y=ac
            }
            return o(W,Y,ab)
        }
        function f(Z){
            var ab,Y,X,aa,t,W,V;
            if(Z!=j){
                ab=e.createDocumentFragment()
            }
            if(N[U]==N[z]){
                return ab
            }
            if(N[h].nodeType==3){
                Y=N[h].nodeValue;
                X=Y.substring(N[U],N[z]);
                if(Z!=E){
                    N[h].deleteData(N[U],N[z]-N[U]);
                    N.collapse(D)
                }
                if(Z==j){
                    return
                }
                ab.appendChild(e.createTextNode(X));
                return ab
            }
            aa=O(N[h],N[U]);
            t=N[z]-N[U];
            while(t>0){
                W=aa.nextSibling;
                V=y(aa,Z);
                if(ab){
                    ab.appendChild(V)
                }
                --t;
                aa=W
            }
            if(Z!=E){
                N.collapse(D)
            }
            return ab
        }
        function r(ab,Y){
            var aa,Z,V,t,X,W;
            if(Y!=j){
                aa=e.createDocumentFragment()
            }
            Z=i(ab,Y);
            if(aa){
                aa.appendChild(Z)
            }
            V=n(ab);
            t=V-N[U];
            if(t<=0){
                if(Y!=E){
                    N.setEndBefore(ab);
                    N.collapse(R)
                }
                return aa
            }
            Z=ab.previousSibling;
            while(t>0){
                X=Z.previousSibling;
                W=y(Z,Y);
                if(aa){
                    aa.insertBefore(W,aa.firstChild)
                }
                --t;
                Z=X
            }
            if(Y!=E){
                N.setEndBefore(ab);
                N.collapse(R)
            }
            return aa
        }
        function T(Z,Y){
            var ab,V,aa,t,X,W;
            if(Y!=j){
                ab=e.createDocumentFragment()
            }
            aa=Q(Z,Y);
            if(ab){
                ab.appendChild(aa)
            }
            V=n(Z);
            ++V;
            t=N[z]-V;
            aa=Z.nextSibling;
            while(t>0){
                X=aa.nextSibling;
                W=y(aa,Y);
                if(ab){
                    ab.appendChild(W)
                }
                --t;
                aa=X
            }
            if(Y!=E){
                N.setStartAfter(Z);
                N.collapse(D)
            }
            return ab
        }
        function o(Z,t,ac){
            var W,ae,Y,aa,ab,V,ad,X;
            if(ac!=j){
                ae=e.createDocumentFragment()
            }
            W=Q(Z,ac);
            if(ae){
                ae.appendChild(W)
            }
            Y=Z.parentNode;
            aa=n(Z);
            ab=n(t);
            ++aa;
            V=ab-aa;
            ad=Z.nextSibling;
            while(V>0){
                X=ad.nextSibling;
                W=y(ad,ac);
                if(ae){
                    ae.appendChild(W)
                }
                ad=X;
                --V
            }
            W=i(t,ac);
            if(ae){
                ae.appendChild(W)
            }
            if(ac!=E){
                N.setStartAfter(Z);
                N.collapse(D)
            }
            return ae
        }
        function i(aa,ab){
            var W=O(N[P],N[z]-1),ac,Z,Y,t,V,X=W!=N[P];
            if(W==aa){
                return L(W,X,R,ab)
            }
            ac=W.parentNode;
            Z=L(ac,R,R,ab);
            while(ac){
                while(W){
                    Y=W.previousSibling;
                    t=L(W,X,R,ab);
                    if(ab!=j){
                        Z.insertBefore(t,Z.firstChild)
                    }
                    X=D;
                    W=Y
                }
                if(ac==aa){
                    return Z
                }
                W=ac.previousSibling;
                ac=ac.parentNode;
                V=L(ac,R,R,ab);
                if(ab!=j){
                    V.appendChild(Z)
                }
                Z=V
            }
        }
        function Q(aa,ab){
            var X=O(N[h],N[U]),Y=X!=N[h],ac,Z,W,t,V;
            if(X==aa){
                return L(X,Y,D,ab)
            }
            ac=X.parentNode;
            Z=L(ac,R,D,ab);
            while(ac){
                while(X){
                    W=X.nextSibling;
                    t=L(X,Y,D,ab);
                    if(ab!=j){
                        Z.appendChild(t)
                    }
                    Y=D;
                    X=W
                }
                if(ac==aa){
                    return Z
                }
                X=ac.nextSibling;
                ac=ac.parentNode;
                V=L(ac,R,D,ab);
                if(ab!=j){
                    V.appendChild(Z)
                }
                Z=V
            }
        }
        function L(t,Y,ab,ac){
            var X,W,Z,V,aa;
            if(Y){
                return y(t,ac)
            }
            if(t.nodeType==3){
                X=t.nodeValue;
                if(ab){
                    V=N[U];
                    W=X.substring(V);
                    Z=X.substring(0,V)
                }else{
                    V=N[z];
                    W=X.substring(0,V);
                    Z=X.substring(V)
                }
                if(ac!=E){
                    t.nodeValue=Z
                }
                if(ac==j){
                    return
                }
                aa=t.cloneNode(R);
                aa.nodeValue=W;
                return aa
            }
            if(ac==j){
                return
            }
            return t.cloneNode(R)
        }
        function y(V,t){
            if(t!=j){
                return t==E?V.cloneNode(D):V
            }
            V.parentNode.removeChild(V)
        }
    }
    a.Range=b
})(tinymce.dom);
(function(){
    function a(g){
        var i=this,j="\uFEFF",e,h,d=g.dom,c=true,f=false;
        function b(){
            var n=g.getRng(),k=d.createRng(),m,o;
            m=n.item?n.item(0):n.parentElement();
            if(m.ownerDocument!=d.doc){
                return k
            }
            o=g.isCollapsed();
            if(n.item||!m.hasChildNodes()){
                if(o){
                    k.setStart(m,0);
                    k.setEnd(m,0)
                }else{
                    k.setStart(m.parentNode,d.nodeIndex(m));
                    k.setEnd(k.startContainer,k.startOffset+1)
                }
                return k
            }
            function l(s){
                var u,q,t,p,A=0,x,y,z,r,v;
                r=n.duplicate();
                r.collapse(s);
                u=d.create("a");
                z=r.parentElement();
                if(!z.hasChildNodes()){
                    k[s?"setStart":"setEnd"](z,0);
                    return
                }
                z.appendChild(u);
                r.moveToElementText(u);
                v=n.compareEndPoints(s?"StartToStart":"EndToEnd",r);
                if(v>0){
                    k[s?"setStartAfter":"setEndAfter"](z);
                    d.remove(u);
                    return
                }
                p=tinymce.grep(z.childNodes);
                x=p.length-1;
                while(A<=x){
                    y=Math.floor((A+x)/2);
                    z.insertBefore(u,p[y]);
                    r.moveToElementText(u);
                    v=n.compareEndPoints(s?"StartToStart":"EndToEnd",r);
                    if(v>0){
                        A=y+1
                    }else{
                        if(v<0){
                            x=y-1
                        }else{
                            found=true;
                            break
                        }
                    }
                }
                q=v>0||y==0?u.nextSibling:u.previousSibling;
                if(q.nodeType==1){
                    d.remove(u);
                    t=d.nodeIndex(q);
                    q=q.parentNode;
                    if(!s||y>0){
                        t++
                    }
                }else{
                    if(v>0||y==0){
                        r.setEndPoint(s?"StartToStart":"EndToEnd",n);
                        t=r.text.length
                    }else{
                        r.setEndPoint(s?"StartToStart":"EndToEnd",n);
                        t=q.nodeValue.length-r.text.length
                    }
                    d.remove(u)
                }
                k[s?"setStart":"setEnd"](q,t)
            }
            l(true);
            if(!o){
                l()
            }
            return k
        }
        this.addRange=function(k){
            var p,n,m,r,u,s,t=g.dom.doc,o=t.body;
            function l(B){
                var x,A,v,z,y;
                v=d.create("a");
                x=B?m:u;
                A=B?r:s;
                z=p.duplicate();
                if(x==t||x==t.documentElement){
                    x=o;
                    A=0
                }
                if(x.nodeType==3){
                    x.parentNode.insertBefore(v,x);
                    z.moveToElementText(v);
                    z.moveStart("character",A);
                    d.remove(v);
                    p.setEndPoint(B?"StartToStart":"EndToEnd",z)
                }else{
                    y=x.childNodes;
                    if(y.length){
                        if(A>=y.length){
                            d.insertAfter(v,y[y.length-1])
                        }else{
                            x.insertBefore(v,y[A])
                        }
                        z.moveToElementText(v)
                    }else{
                        v=t.createTextNode(j);
                        x.appendChild(v);
                        z.moveToElementText(v.parentNode);
                        z.collapse(c)
                    }
                    p.setEndPoint(B?"StartToStart":"EndToEnd",z);
                    d.remove(v)
                }
            }
            this.destroy();
            m=k.startContainer;
            r=k.startOffset;
            u=k.endContainer;
            s=k.endOffset;
            p=o.createTextRange();
            if(m==u&&m.nodeType==1&&r==s-1){
                if(r==s-1){
                    try{
                        n=o.createControlRange();
                        n.addElement(m.childNodes[r]);
                        n.select();
                        return
                    }catch(q){}
                }
            }
            l(true);
            l();
            p.select()
        };

        this.getRangeAt=function(){
            if(!e||!tinymce.dom.RangeUtils.compareRanges(h,g.getRng())){
                e=b();
                h=g.getRng()
            }
            try{
                e.startContainer.nextSibling
            }catch(k){
                e=b();
                h=null
            }
            return e
        };
    
        this.destroy=function(){
            h=e=null
        }
    }
    tinymce.dom.TridentSelection=a
})();
(function(){
    var p=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,j=0,d=Object.prototype.toString,o=false,i=true;
    [0,0].sort(function(){
        i=false;
        return 0
    });
    var b=function(v,e,z,A){
        z=z||[];
        e=e||document;
        var C=e;
        if(e.nodeType!==1&&e.nodeType!==9){
            return[]
        }
        if(!v||typeof v!=="string"){
            return z
        }
        var x=[],s,E,H,r,u=true,t=b.isXML(e),B=v,D,G,F,y;
        do{
            p.exec("");
            s=p.exec(B);
            if(s){
                B=s[3];
                x.push(s[1]);
                if(s[2]){
                    r=s[3];
                    break
                }
            }
        }while(s);
        if(x.length>1&&k.exec(v)){
            if(x.length===2&&f.relative[x[0]]){
                E=h(x[0]+x[1],e)
            }else{
                E=f.relative[x[0]]?[e]:b(x.shift(),e);
                while(x.length){
                    v=x.shift();
                    if(f.relative[v]){
                        v+=x.shift()
                    }
                    E=h(v,E)
                }
            }
        }else{
            if(!A&&x.length>1&&e.nodeType===9&&!t&&f.match.ID.test(x[0])&&!f.match.ID.test(x[x.length-1])){
                D=b.find(x.shift(),e,t);
                e=D.expr?b.filter(D.expr,D.set)[0]:D.set[0]
            }
            if(e){
                D=A?{
                    expr:x.pop(),
                    set:a(A)
                }:b.find(x.pop(),x.length===1&&(x[0]==="~"||x[0]==="+")&&e.parentNode?e.parentNode:e,t);
                E=D.expr?b.filter(D.expr,D.set):D.set;
                if(x.length>0){
                    H=a(E)
                }else{
                    u=false
                }while(x.length){
                    G=x.pop();
                    F=G;
                    if(!f.relative[G]){
                        G=""
                    }else{
                        F=x.pop()
                    }
                    if(F==null){
                        F=e
                    }
                    f.relative[G](H,F,t)
                }
            }else{
                H=x=[]
            }
        }
        if(!H){
            H=E
        }
        if(!H){
            b.error(G||v)
        }
        if(d.call(H)==="[object Array]"){
            if(!u){
                z.push.apply(z,H)
            }else{
                if(e&&e.nodeType===1){
                    for(y=0;H[y]!=null;y++){
                        if(H[y]&&(H[y]===true||H[y].nodeType===1&&b.contains(e,H[y]))){
                            z.push(E[y])
                        }
                    }
                }else{
                    for(y=0;H[y]!=null;y++){
                        if(H[y]&&H[y].nodeType===1){
                            z.push(E[y])
                        }
                    }
                }
            }
        }else{
            a(H,z)
        }
        if(r){
            b(r,C,z,A);
            b.uniqueSort(z)
        }
        return z
    };

    b.uniqueSort=function(r){
        if(c){
            o=i;
            r.sort(c);
            if(o){
                for(var e=1;e<r.length;e++){
                    if(r[e]===r[e-1]){
                        r.splice(e--,1)
                    }
                }
            }
        }
        return r
    };

    b.matches=function(e,r){
        return b(e,null,null,r)
    };
    
    b.find=function(y,e,z){
        var x;
        if(!y){
            return[]
        }
        for(var t=0,s=f.order.length;t<s;t++){
            var v=f.order[t],u;
            if((u=f.leftMatch[v].exec(y))){
                var r=u[1];
                u.splice(1,1);
                if(r.substr(r.length-1)!=="\\"){
                    u[1]=(u[1]||"").replace(/\\/g,"");
                    x=f.find[v](u,e,z);
                    if(x!=null){
                        y=y.replace(f.match[v],"");
                        break
                    }
                }
            }
        }
        if(!x){
            x=e.getElementsByTagName("*")
        }
        return{
            set:x,
            expr:y
        }
    };

    b.filter=function(C,B,F,u){
        var s=C,H=[],z=B,x,e,y=B&&B[0]&&b.isXML(B[0]);
        while(C&&B.length){
            for(var A in f.filter){
                if((x=f.leftMatch[A].exec(C))!=null&&x[2]){
                    var r=f.filter[A],G,E,t=x[1];
                    e=false;
                    x.splice(1,1);
                    if(t.substr(t.length-1)==="\\"){
                        continue
                    }
                    if(z===H){
                        H=[]
                    }
                    if(f.preFilter[A]){
                        x=f.preFilter[A](x,z,F,H,u,y);
                        if(!x){
                            e=G=true
                        }else{
                            if(x===true){
                                continue
                            }
                        }
                    }
                    if(x){
                        for(var v=0;(E=z[v])!=null;v++){
                            if(E){
                                G=r(E,x,v,z);
                                var D=u^!!G;
                                if(F&&G!=null){
                                    if(D){
                                        e=true
                                    }else{
                                        z[v]=false
                                    }
                                }else{
                                    if(D){
                                        H.push(E);
                                        e=true
                                    }
                                }
                            }
                        }
                    }
                    if(G!==undefined){
                        if(!F){
                            z=H
                        }
                        C=C.replace(f.match[A],"");
                        if(!e){
                            return[]
                        }
                        break
                    }
                }
            }
            if(C===s){
                if(e==null){
                    b.error(C)
                }else{
                    break
                }
            }
            s=C
        }
        return z
    };

    b.error=function(e){
        throw"Syntax error, unrecognized expression: "+e
    };
    
    var f=b.selectors={
        order:["ID","NAME","TAG"],
        match:{
            ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
            CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
            NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
            ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,
            TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
            CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,
            POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
            PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
        },
        leftMatch:{},
        attrMap:{
            "class":"className",
            "for":"htmlFor"
        },
        attrHandle:{
            href:function(e){
                return e.getAttribute("href")
            }
        },
        relative:{
            "+":function(x,r){
                var t=typeof r==="string",v=t&&!/\W/.test(r),y=t&&!v;
                if(v){
                    r=r.toLowerCase()
                }
                for(var s=0,e=x.length,u;s<e;s++){
                    if((u=x[s])){
                        while((u=u.previousSibling)&&u.nodeType!==1){}
                        x[s]=y||u&&u.nodeName.toLowerCase()===r?u||false:u===r
                    }
                }
                if(y){
                    b.filter(r,x,true)
                }
            },
            ">":function(x,r){
                var u=typeof r==="string",v,s=0,e=x.length;
                if(u&&!/\W/.test(r)){
                    r=r.toLowerCase();
                    for(;s<e;s++){
                        v=x[s];
                        if(v){
                            var t=v.parentNode;
                            x[s]=t.nodeName.toLowerCase()===r?t:false
                        }
                    }
                }else{
                    for(;s<e;s++){
                        v=x[s];
                        if(v){
                            x[s]=u?v.parentNode:v.parentNode===r
                        }
                    }
                    if(u){
                        b.filter(r,x,true)
                    }
                }
            },
            "":function(t,r,v){
                var s=j++,e=q,u;
                if(typeof r==="string"&&!/\W/.test(r)){
                    r=r.toLowerCase();
                    u=r;
                    e=n
                }
                e("parentNode",r,s,t,u,v)
            },
            "~":function(t,r,v){
                var s=j++,e=q,u;
                if(typeof r==="string"&&!/\W/.test(r)){
                    r=r.toLowerCase();
                    u=r;
                    e=n
                }
                e("previousSibling",r,s,t,u,v)
            }
        },
        find:{
            ID:function(r,s,t){
                if(typeof s.getElementById!=="undefined"&&!t){
                    var e=s.getElementById(r[1]);
                    return e?[e]:[]
                }
            },
            NAME:function(s,v){
                if(typeof v.getElementsByName!=="undefined"){
                    var r=[],u=v.getElementsByName(s[1]);
                    for(var t=0,e=u.length;t<e;t++){
                        if(u[t].getAttribute("name")===s[1]){
                            r.push(u[t])
                        }
                    }
                    return r.length===0?null:r
                }
            },
            TAG:function(e,r){
                return r.getElementsByTagName(e[1])
            }
        },
        preFilter:{
            CLASS:function(t,r,s,e,x,y){
                t=" "+t[1].replace(/\\/g,"")+" ";
                if(y){
                    return t
                }
                for(var u=0,v;(v=r[u])!=null;u++){
                    if(v){
                        if(x^(v.className&&(" "+v.className+" ").replace(/[\t\n]/g," ").indexOf(t)>=0)){
                            if(!s){
                                e.push(v)
                            }
                        }else{
                            if(s){
                                r[u]=false
                            }
                        }
                    }
                }
                return false
            },
            ID:function(e){
                return e[1].replace(/\\/g,"")
            },
            TAG:function(r,e){
                return r[1].toLowerCase()
            },
            CHILD:function(e){
                if(e[1]==="nth"){
                    var r=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(e[2]==="even"&&"2n"||e[2]==="odd"&&"2n+1"||!/\D/.test(e[2])&&"0n+"+e[2]||e[2]);
                    e[2]=(r[1]+(r[2]||1))-0;
                    e[3]=r[3]-0
                }
                e[0]=j++;
                return e
            },
            ATTR:function(u,r,s,e,v,x){
                var t=u[1].replace(/\\/g,"");
                if(!x&&f.attrMap[t]){
                    u[1]=f.attrMap[t]
                }
                if(u[2]==="~="){
                    u[4]=" "+u[4]+" "
                }
                return u
            },
            PSEUDO:function(u,r,s,e,v){
                if(u[1]==="not"){
                    if((p.exec(u[3])||"").length>1||/^\w/.test(u[3])){
                        u[3]=b(u[3],null,null,r)
                    }else{
                        var t=b.filter(u[3],r,s,true^v);
                        if(!s){
                            e.push.apply(e,t)
                        }
                        return false
                    }
                }else{
                    if(f.match.POS.test(u[0])||f.match.CHILD.test(u[0])){
                        return true
                    }
                }
                return u
            },
            POS:function(e){
                e.unshift(true);
                return e
            }
        },
        filters:{
            enabled:function(e){
                return e.disabled===false&&e.type!=="hidden"
            },
            disabled:function(e){
                return e.disabled===true
            },
            checked:function(e){
                return e.checked===true
            },
            selected:function(e){
                e.parentNode.selectedIndex;
                return e.selected===true
            },
            parent:function(e){
                return !!e.firstChild
            },
            empty:function(e){
                return !e.firstChild
            },
            has:function(s,r,e){
                return !!b(e[3],s).length
            },
            header:function(e){
                return(/h\d/i).test(e.nodeName)
            },
            text:function(e){
                return"text"===e.type
            },
            radio:function(e){
                return"radio"===e.type
            },
            checkbox:function(e){
                return"checkbox"===e.type
            },
            file:function(e){
                return"file"===e.type
            },
            password:function(e){
                return"password"===e.type
            },
            submit:function(e){
                return"submit"===e.type
            },
            image:function(e){
                return"image"===e.type
            },
            reset:function(e){
                return"reset"===e.type
            },
            button:function(e){
                return"button"===e.type||e.nodeName.toLowerCase()==="button"
            },
            input:function(e){
                return(/input|select|textarea|button/i).test(e.nodeName)
            }
        },
        setFilters:{
            first:function(r,e){
                return e===0
            },
            last:function(s,r,e,t){
                return r===t.length-1
            },
            even:function(r,e){
                return e%2===0
            },
            odd:function(r,e){
                return e%2===1
            },
            lt:function(s,r,e){
                return r<e[3]-0
            },
            gt:function(s,r,e){
                return r>e[3]-0
            },
            nth:function(s,r,e){
                return e[3]-0===r
            },
            eq:function(s,r,e){
                return e[3]-0===r
            }
        },
        filter:{
            PSEUDO:function(s,y,x,z){
                var e=y[1],r=f.filters[e];
                if(r){
                    return r(s,x,y,z)
                }else{
                    if(e==="contains"){
                        return(s.textContent||s.innerText||b.getText([s])||"").indexOf(y[3])>=0
                    }else{
                        if(e==="not"){
                            var t=y[3];
                            for(var v=0,u=t.length;v<u;v++){
                                if(t[v]===s){
                                    return false
                                }
                            }
                            return true
                        }else{
                            b.error("Syntax error, unrecognized expression: "+e)
                        }
                    }
                }
            },
            CHILD:function(e,t){
                var x=t[1],r=e;
                switch(x){
                    case"only":case"first":
                        while((r=r.previousSibling)){
                            if(r.nodeType===1){
                                return false
                            }
                        }
                        if(x==="first"){
                            return true
                        }
                        r=e;
                    case"last":
                        while((r=r.nextSibling)){
                            if(r.nodeType===1){
                                return false
                            }
                        }
                        return true;
                    case"nth":
                        var s=t[2],A=t[3];
                        if(s===1&&A===0){
                            return true
                        }
                        var v=t[0],z=e.parentNode;
                        if(z&&(z.sizcache!==v||!e.nodeIndex)){
                            var u=0;
                            for(r=z.firstChild;r;r=r.nextSibling){
                                if(r.nodeType===1){
                                    r.nodeIndex=++u
                                }
                            }
                            z.sizcache=v
                        }
                        var y=e.nodeIndex-A;
                        if(s===0){
                            return y===0
                        }else{
                            return(y%s===0&&y/s>=0)
                        }
                }
            },
            ID:function(r,e){
                return r.nodeType===1&&r.getAttribute("id")===e
            },
            TAG:function(r,e){
                return(e==="*"&&r.nodeType===1)||r.nodeName.toLowerCase()===e
            },
            CLASS:function(r,e){
                return(" "+(r.className||r.getAttribute("class"))+" ").indexOf(e)>-1
            },
            ATTR:function(v,t){
                var s=t[1],e=f.attrHandle[s]?f.attrHandle[s](v):v[s]!=null?v[s]:v.getAttribute(s),x=e+"",u=t[2],r=t[4];
                return e==null?u==="!=":u==="="?x===r:u==="*="?x.indexOf(r)>=0:u==="~="?(" "+x+" ").indexOf(r)>=0:!r?x&&e!==false:u==="!="?x!==r:u==="^="?x.indexOf(r)===0:u==="$="?x.substr(x.length-r.length)===r:u==="|="?x===r||x.substr(0,r.length+1)===r+"-":false
            },
            POS:function(u,r,s,v){
                var e=r[2],t=f.setFilters[e];
                if(t){
                    return t(u,s,r,v)
                }
            }
        }
    };

    var k=f.match.POS,g=function(r,e){
        return"\\"+(e-0+1)
    };
    
    for(var m in f.match){
        f.match[m]=new RegExp(f.match[m].source+(/(?![^\[]*\])(?![^\(]*\))/.source));
        f.leftMatch[m]=new RegExp(/(^(?:.|\r|\n)*?)/.source+f.match[m].source.replace(/\\(\d+)/g,g))
    }
    var a=function(r,e){
        r=Array.prototype.slice.call(r,0);
        if(e){
            e.push.apply(e,r);
            return e
        }
        return r
    };
    
    try{
        Array.prototype.slice.call(document.documentElement.childNodes,0)[0].nodeType
    }catch(l){
        a=function(u,t){
            var r=t||[],s=0;
            if(d.call(u)==="[object Array]"){
                Array.prototype.push.apply(r,u)
            }else{
                if(typeof u.length==="number"){
                    for(var e=u.length;s<e;s++){
                        r.push(u[s])
                    }
                }else{
                    for(;u[s];s++){
                        r.push(u[s])
                    }
                }
            }
            return r
        }
    }
    var c;
    if(document.documentElement.compareDocumentPosition){
        c=function(r,e){
            if(!r.compareDocumentPosition||!e.compareDocumentPosition){
                if(r==e){
                    o=true
                }
                return r.compareDocumentPosition?-1:1
            }
            var s=r.compareDocumentPosition(e)&4?-1:r===e?0:1;
            if(s===0){
                o=true
            }
            return s
        }
    }else{
        if("sourceIndex" in document.documentElement){
            c=function(r,e){
                if(!r.sourceIndex||!e.sourceIndex){
                    if(r==e){
                        o=true
                    }
                    return r.sourceIndex?-1:1
                }
                var s=r.sourceIndex-e.sourceIndex;
                if(s===0){
                    o=true
                }
                return s
            }
        }else{
            if(document.createRange){
                c=function(t,r){
                    if(!t.ownerDocument||!r.ownerDocument){
                        if(t==r){
                            o=true
                        }
                        return t.ownerDocument?-1:1
                    }
                    var s=t.ownerDocument.createRange(),e=r.ownerDocument.createRange();
                    s.setStart(t,0);
                    s.setEnd(t,0);
                    e.setStart(r,0);
                    e.setEnd(r,0);
                    var u=s.compareBoundaryPoints(Range.START_TO_END,e);
                    if(u===0){
                        o=true
                    }
                    return u
                }
            }
        }
    }
    b.getText=function(e){
        var r="",t;
        for(var s=0;e[s];s++){
            t=e[s];
            if(t.nodeType===3||t.nodeType===4){
                r+=t.nodeValue
            }else{
                if(t.nodeType!==8){
                    r+=b.getText(t.childNodes)
                }
            }
        }
        return r
    };
    (function(){
        var r=document.createElement("div"),s="script"+(new Date()).getTime();
        r.innerHTML="<a name='"+s+"'/>";
        var e=document.documentElement;
        e.insertBefore(r,e.firstChild);
        if(document.getElementById(s)){
            f.find.ID=function(u,v,x){
                if(typeof v.getElementById!=="undefined"&&!x){
                    var t=v.getElementById(u[1]);
                    return t?t.id===u[1]||typeof t.getAttributeNode!=="undefined"&&t.getAttributeNode("id").nodeValue===u[1]?[t]:undefined:[]
                }
            };
        
            f.filter.ID=function(v,t){
                var u=typeof v.getAttributeNode!=="undefined"&&v.getAttributeNode("id");
                return v.nodeType===1&&u&&u.nodeValue===t
            }
        }
        e.removeChild(r);
        e=r=null
    })();
    (function(){
        var e=document.createElement("div");
        e.appendChild(document.createComment(""));
        if(e.getElementsByTagName("*").length>0){
            f.find.TAG=function(r,v){
                var u=v.getElementsByTagName(r[1]);
                if(r[1]==="*"){
                    var t=[];
                    for(var s=0;u[s];s++){
                        if(u[s].nodeType===1){
                            t.push(u[s])
                        }
                    }
                    u=t
                }
                return u
            }
        }
        e.innerHTML="<a href='#'></a>";
        if(e.firstChild&&typeof e.firstChild.getAttribute!=="undefined"&&e.firstChild.getAttribute("href")!=="#"){
            f.attrHandle.href=function(r){
                return r.getAttribute("href",2)
            }
        }
        e=null
    })();
    if(document.querySelectorAll){
        (function(){
            var e=b,s=document.createElement("div");
            s.innerHTML="<p class='TEST'></p>";
            if(s.querySelectorAll&&s.querySelectorAll(".TEST").length===0){
                return
            }
            b=function(x,v,t,u){
                v=v||document;
                if(!u&&v.nodeType===9&&!b.isXML(v)){
                    try{
                        return a(v.querySelectorAll(x),t)
                    }catch(y){}
                }
                return e(x,v,t,u)
            };
        
            for(var r in e){
                b[r]=e[r]
            }
            s=null
        })()
    }(function(){
        var e=document.createElement("div");
        e.innerHTML="<div class='test e'></div><div class='test'></div>";
        if(!e.getElementsByClassName||e.getElementsByClassName("e").length===0){
            return
        }
        e.lastChild.className="e";
        if(e.getElementsByClassName("e").length===1){
            return
        }
        f.order.splice(1,0,"CLASS");
        f.find.CLASS=function(r,s,t){
            if(typeof s.getElementsByClassName!=="undefined"&&!t){
                return s.getElementsByClassName(r[1])
            }
        };
    
        e=null
    })();
    function n(r,x,v,A,y,z){
        for(var t=0,s=A.length;t<s;t++){
            var e=A[t];
            if(e){
                e=e[r];
                var u=false;
                while(e){
                    if(e.sizcache===v){
                        u=A[e.sizset];
                        break
                    }
                    if(e.nodeType===1&&!z){
                        e.sizcache=v;
                        e.sizset=t
                    }
                    if(e.nodeName.toLowerCase()===x){
                        u=e;
                        break
                    }
                    e=e[r]
                }
                A[t]=u
            }
        }
    }
    function q(r,x,v,A,y,z){
        for(var t=0,s=A.length;t<s;t++){
            var e=A[t];
            if(e){
                e=e[r];
                var u=false;
                while(e){
                    if(e.sizcache===v){
                        u=A[e.sizset];
                        break
                    }
                    if(e.nodeType===1){
                        if(!z){
                            e.sizcache=v;
                            e.sizset=t
                        }
                        if(typeof x!=="string"){
                            if(e===x){
                                u=true;
                                break
                            }
                        }else{
                            if(b.filter(x,[e]).length>0){
                                u=e;
                                break
                            }
                        }
                    }
                    e=e[r]
                }
                A[t]=u
            }
        }
    }
    b.contains=document.compareDocumentPosition?function(r,e){
        return !!(r.compareDocumentPosition(e)&16)
    }:function(r,e){
        return r!==e&&(r.contains?r.contains(e):true)
    };
    
    b.isXML=function(e){
        var r=(e?e.ownerDocument||e:0).documentElement;
        return r?r.nodeName!=="HTML":false
    };
    
    var h=function(e,y){
        var t=[],u="",v,s=y.nodeType?[y]:y;
        while((v=f.match.PSEUDO.exec(e))){
            u+=v[0];
            e=e.replace(f.match.PSEUDO,"")
        }
        e=f.relative[e]?e+"*":e;
        for(var x=0,r=s.length;x<r;x++){
            b(e,s[x],t)
        }
        return b.filter(u,t)
    };
    
    window.tinymce.dom.Sizzle=b
})();
(function(d){
    var f=d.each,c=d.DOM,b=d.isIE,e=d.isWebKit,a;
    d.create("tinymce.dom.EventUtils",{
        EventUtils:function(){
            this.inits=[];
            this.events=[]
        },
        add:function(m,p,l,j){
            var g,h=this,i=h.events,k;
            if(p instanceof Array){
                k=[];
                f(p,function(o){
                    k.push(h.add(m,o,l,j))
                });
                return k
            }
            if(m&&m.hasOwnProperty&&m instanceof Array){
                k=[];
                f(m,function(n){
                    n=c.get(n);
                    k.push(h.add(n,p,l,j))
                });
                return k
            }
            m=c.get(m);
            if(!m){
                return
            }
            g=function(n){
                if(h.disabled){
                    return
                }
                n=n||window.event;
                if(n&&b){
                    if(!n.target){
                        n.target=n.srcElement
                    }
                    d.extend(n,h._stoppers)
                }
                if(!j){
                    return l(n)
                }
                return l.call(j,n)
            };
                
            if(p=="unload"){
                d.unloads.unshift({
                    func:g
                });
                return g
            }
            if(p=="init"){
                if(h.domLoaded){
                    g()
                }else{
                    h.inits.push(g)
                }
                return g
            }
            i.push({
                obj:m,
                name:p,
                func:l,
                cfunc:g,
                scope:j
            });
            h._add(m,p,g);
            return l
        },
        remove:function(l,m,k){
            var h=this,g=h.events,i=false,j;
            if(l&&l.hasOwnProperty&&l instanceof Array){
                j=[];
                f(l,function(n){
                    n=c.get(n);
                    j.push(h.remove(n,m,k))
                });
                return j
            }
            l=c.get(l);
            f(g,function(o,n){
                if(o.obj==l&&o.name==m&&(!k||(o.func==k||o.cfunc==k))){
                    g.splice(n,1);
                    h._remove(l,m,o.cfunc);
                    i=true;
                    return false
                }
            });
            return i
        },
        clear:function(l){
            var j=this,g=j.events,h,k;
            if(l){
                l=c.get(l);
                for(h=g.length-1;h>=0;h--){
                    k=g[h];
                    if(k.obj===l){
                        j._remove(k.obj,k.name,k.cfunc);
                        k.obj=k.cfunc=null;
                        g.splice(h,1)
                    }
                }
            }
        },
        cancel:function(g){
            if(!g){
                return false
            }
            this.stop(g);
            return this.prevent(g)
        },
        stop:function(g){
            if(g.stopPropagation){
                g.stopPropagation()
            }else{
                g.cancelBubble=true
            }
            return false
        },
        prevent:function(g){
            if(g.preventDefault){
                g.preventDefault()
            }else{
                g.returnValue=false
            }
            return false
        },
        destroy:function(){
            var g=this;
            f(g.events,function(j,h){
                g._remove(j.obj,j.name,j.cfunc);
                j.obj=j.cfunc=null
            });
            g.events=[];
            g=null
        },
        _add:function(h,i,g){
            if(h.attachEvent){
                h.attachEvent("on"+i,g)
            }else{
                if(h.addEventListener){
                    h.addEventListener(i,g,false)
                }else{
                    h["on"+i]=g
                }
            }
        },
        _remove:function(i,j,h){
            if(i){
                try{
                    if(i.detachEvent){
                        i.detachEvent("on"+j,h)
                    }else{
                        if(i.removeEventListener){
                            i.removeEventListener(j,h,false)
                        }else{
                            i["on"+j]=null
                        }
                    }
                }catch(g){}
            }
        },
        _pageInit:function(h){
            var g=this;
            if(g.domLoaded){
                return
            }
            g.domLoaded=true;
            f(g.inits,function(i){
                i()
            });
            g.inits=[]
        },
        _wait:function(i){
            var g=this,h=i.document;
            if(i.tinyMCE_GZ&&tinyMCE_GZ.loaded){
                g.domLoaded=1;
                return
            }
            if(h.attachEvent){
                h.attachEvent("onreadystatechange",function(){
                    if(h.readyState==="complete"){
                        h.detachEvent("onreadystatechange",arguments.callee);
                        g._pageInit(i)
                    }
                });
                if(h.documentElement.doScroll&&i==i.top){
                    (function(){
                        if(g.domLoaded){
                            return
                        }
                        try{
                            h.documentElement.doScroll("left")
                        }catch(j){
                            setTimeout(arguments.callee,0);
                            return
                        }
                        g._pageInit(i)
                    })()
                }
            }else{
                if(h.addEventListener){
                    g._add(i,"DOMContentLoaded",function(){
                        g._pageInit(i)
                    })
                }
            }
            g._add(i,"load",function(){
                g._pageInit(i)
            })
        },
        _stoppers:{
            preventDefault:function(){
                this.returnValue=false
            },
            stopPropagation:function(){
                this.cancelBubble=true
            }
        }
    });
    a=d.dom.Event=new d.dom.EventUtils();
    a._wait(window);
    d.addUnload(function(){
        a.destroy()
    })
})(tinymce);
(function(a){
    a.dom.Element=function(f,d){
        var b=this,e,c;
        b.settings=d=d||{};
        
        b.id=f;
        b.dom=e=d.dom||a.DOM;
        if(!a.isIE){
            c=e.get(b.id)
        }
        a.each(("getPos,getRect,getParent,add,setStyle,getStyle,setStyles,setAttrib,setAttribs,getAttrib,addClass,removeClass,hasClass,getOuterHTML,setOuterHTML,remove,show,hide,isHidden,setHTML,get").split(/,/),function(g){
            b[g]=function(){
                var h=[f],j;
                for(j=0;j<arguments.length;j++){
                    h.push(arguments[j])
                }
                h=e[g].apply(e,h);
                b.update(g);
                return h
            }
        });
        a.extend(b,{
            on:function(i,h,g){
                return a.dom.Event.add(b.id,i,h,g)
            },
            getXY:function(){
                return{
                    x:parseInt(b.getStyle("left")),
                    y:parseInt(b.getStyle("top"))
                }
            },
            getSize:function(){
                var g=e.get(b.id);
                return{
                    w:parseInt(b.getStyle("width")||g.clientWidth),
                    h:parseInt(b.getStyle("height")||g.clientHeight)
                }
            },
            moveTo:function(g,h){
                b.setStyles({
                    left:g,
                    top:h
                })
            },
            moveBy:function(g,i){
                var h=b.getXY();
                b.moveTo(h.x+g,h.y+i)
            },
            resizeTo:function(g,i){
                b.setStyles({
                    width:g,
                    height:i
                })
            },
            resizeBy:function(g,j){
                var i=b.getSize();
                b.resizeTo(i.w+g,i.h+j)
            },
            update:function(h){
                var g;
                if(a.isIE6&&d.blocker){
                    h=h||"";
                    if(h.indexOf("get")===0||h.indexOf("has")===0||h.indexOf("is")===0){
                        return
                    }
                    if(h=="remove"){
                        e.remove(b.blocker);
                        return
                    }
                    if(!b.blocker){
                        b.blocker=e.uniqueId();
                        g=e.add(d.container||e.getRoot(),"iframe",{
                            id:b.blocker,
                            style:"position:absolute;",
                            frameBorder:0,
                            src:'javascript:""'
                        });
                        e.setStyle(g,"opacity",0)
                    }else{
                        g=e.get(b.blocker)
                    }
                    e.setStyles(g,{
                        left:b.getStyle("left",1),
                        top:b.getStyle("top",1),
                        width:b.getStyle("width",1),
                        height:b.getStyle("height",1),
                        display:b.getStyle("display",1),
                        zIndex:parseInt(b.getStyle("zIndex",1)||0)-1
                    })
                }
            }
        })
    }
})(tinymce);
(function(c){
    function e(f){
        return f.replace(/[\n\r]+/g,"")
    }
    var b=c.is,a=c.isIE,d=c.each;
    c.create("tinymce.dom.Selection",{
        Selection:function(i,h,g){
            var f=this;
            f.dom=i;
            f.win=h;
            f.serializer=g;
            d(["onBeforeSetContent","onBeforeGetContent","onSetContent","onGetContent"],function(j){
                f[j]=new c.util.Dispatcher(f)
            });
            if(!f.win.getSelection){
                f.tridentSel=new c.dom.TridentSelection(f)
            }
            if(c.isIE&&i.boxModel){
                this._fixIESelection()
            }
            c.addUnload(f.destroy,f)
        },
        getContent:function(g){
            var f=this,h=f.getRng(),l=f.dom.create("body"),j=f.getSel(),i,k,m;
            g=g||{};
            
            i=k="";
            g.get=true;
            g.format=g.format||"html";
            f.onBeforeGetContent.dispatch(f,g);
            if(g.format=="text"){
                return f.isCollapsed()?"":(h.text||(j.toString?j.toString():""))
            }
            if(h.cloneContents){
                m=h.cloneContents();
                if(m){
                    l.appendChild(m)
                }
            }else{
                if(b(h.item)||b(h.htmlText)){
                    l.innerHTML=h.item?h.item(0).outerHTML:h.htmlText
                }else{
                    l.innerHTML=h.toString()
                }
            }
            if(/^\s/.test(l.innerHTML)){
                i=" "
            }
            if(/\s+$/.test(l.innerHTML)){
                k=" "
            }
            g.getInner=true;
            g.content=f.isCollapsed()?"":i+f.serializer.serialize(l,g)+k;
            f.onGetContent.dispatch(f,g);
            return g.content
        },
        setContent:function(k,j){
            var h=this,f=h.getRng(),i,l=h.win.document,m,g;
            j=j||{
                format:"html"
            };
        
            j.set=true;
            k=j.content=k;
            if(!j.no_events){
                h.onBeforeSetContent.dispatch(h,j)
            }
            k=j.content;
            if(f.insertNode){
                k+='<span id="__caret">_</span>';
                if(f.startContainer==l&&f.endContainer==l){
                    l.body.innerHTML=k
                }else{
                    f.deleteContents();
                    if(l.body.childNodes.length==0){
                        l.body.innerHTML=k
                    }else{
                        if(f.createContextualFragment){
                            f.insertNode(f.createContextualFragment(k))
                        }else{
                            m=l.createDocumentFragment();
                            g=l.createElement("div");
                            m.appendChild(g);
                            g.outerHTML=k;
                            f.insertNode(m)
                        }
                    }
                }
                i=h.dom.get("__caret");
                f=l.createRange();
                f.setStartBefore(i);
                f.setEndBefore(i);
                h.setRng(f);
                h.dom.remove("__caret");
                h.setRng(f)
            }else{
                if(f.item){
                    l.execCommand("Delete",false,null);
                    f=h.getRng()
                }
                f.pasteHTML(k)
            }
            if(!j.no_events){
                h.onSetContent.dispatch(h,j)
            }
        },
        getStart:function(){
            var g=this.getRng(),h,f,j,i;
            if(g.duplicate||g.item){
                if(g.item){
                    return g.item(0)
                }
                j=g.duplicate();
                j.collapse(1);
                h=j.parentElement();
                f=i=g.parentElement();
                while(i=i.parentNode){
                    if(i==h){
                        h=f;
                        break
                    }
                }
                return h
            }else{
                h=g.startContainer;
                if(h.nodeType==1&&h.hasChildNodes()){
                    h=h.childNodes[Math.min(h.childNodes.length-1,g.startOffset)]
                }
                if(h&&h.nodeType==3){
                    return h.parentNode
                }
                return h
            }
        },
        getEnd:function(){
            var g=this,h=g.getRng(),i,f;
            if(h.duplicate||h.item){
                if(h.item){
                    return h.item(0)
                }
                h=h.duplicate();
                h.collapse(0);
                i=h.parentElement();
                if(i&&i.nodeName=="BODY"){
                    return i.lastChild||i
                }
                return i
            }else{
                i=h.endContainer;
                f=h.endOffset;
                if(i.nodeType==1&&i.hasChildNodes()){
                    i=i.childNodes[f>0?f-1:f]
                }
                if(i&&i.nodeType==3){
                    return i.parentNode
                }
                return i
            }
        },
        getBookmark:function(r,s){
            var v=this,m=v.dom,g,j,i,n,h,o,p,l="\uFEFF",u;
            function f(x,y){
                var t=0;
                d(m.select(x),function(A,z){
                    if(A==y){
                        t=z
                    }
                });
                return t
            }
            if(r==2){
                function k(){
                    var x=v.getRng(true),t=m.getRoot(),y={};
        
                    function z(C,H){
                        var B=C[H?"startContainer":"endContainer"],G=C[H?"startOffset":"endOffset"],A=[],D,F,E=0;
                        if(B.nodeType==3){
                            if(s){
                                for(D=B.previousSibling;D&&D.nodeType==3;D=D.previousSibling){
                                    G+=D.nodeValue.length
                                }
                            }
                            A.push(G)
                        }else{
                            F=B.childNodes;
                            if(G>=F.length&&F.length){
                                E=1;
                                G=Math.max(0,F.length-1)
                            }
                            A.push(v.dom.nodeIndex(F[G],s)+E)
                        }
                        for(;B&&B!=t;B=B.parentNode){
                            A.push(v.dom.nodeIndex(B,s))
                        }
                        return A
                    }
                    y.start=z(x,true);
                    if(!v.isCollapsed()){
                        y.end=z(x)
                    }
                    return y
                }
                return k()
            }
            if(r){
                return{
                    rng:v.getRng()
                }
            }
            g=v.getRng();
            i=m.uniqueId();
            n=tinyMCE.activeEditor.selection.isCollapsed();
            u="overflow:hidden;line-height:0px";
            if(g.duplicate||g.item){
                if(!g.item){
                    j=g.duplicate();
                    try{
                        g.collapse();
                        g.pasteHTML('<span data-mce-type="bookmark" id="'+i+'_start" style="'+u+'">'+l+"</span>");
                        if(!n){
                            j.collapse(false);
                            g.moveToElementText(j.parentElement());
                            if(g.compareEndPoints("StartToEnd",j)==0){
                                j.move("character",-1)
                            }
                            j.pasteHTML('<span data-mce-type="bookmark" id="'+i+'_end" style="'+u+'">'+l+"</span>")
                        }
                    }catch(q){
                        return null
                    }
                }else{
                    o=g.item(0);
                    h=o.nodeName;
                    return{
                        name:h,
                        index:f(h,o)
                    }
                }
            }else{
                o=v.getNode();
                h=o.nodeName;
                if(h=="IMG"){
                    return{
                        name:h,
                        index:f(h,o)
                    }
                }
                j=g.cloneRange();
                if(!n){
                    j.collapse(false);
                    j.insertNode(m.create("span",{
                        "data-mce-type":"bookmark",
                        id:i+"_end",
                        style:u
                    },l))
                }
                g.collapse(true);
                g.insertNode(m.create("span",{
                    "data-mce-type":"bookmark",
                    id:i+"_start",
                    style:u
                },l))
            }
            v.moveToBookmark({
                id:i,
                keep:1
            });
            return{
                id:i
            }
        },
        moveToBookmark:function(n){
            var r=this,l=r.dom,i,h,f,q,j,s,o,p;
            if(r.tridentSel){
                r.tridentSel.destroy()
            }
            if(n){
                if(n.start){
                    f=l.createRng();
                    q=l.getRoot();
                    function g(z){
                        var t=n[z?"start":"end"],v,x,y,u;
                        if(t){
                            y=t[0];
                            for(x=q,v=t.length-1;v>=1;v--){
                                u=x.childNodes;
                                if(t[v]>u.length-1){
                                    return
                                }
                                x=u[t[v]]
                            }
                            if(x.nodeType===3){
                                y=Math.min(t[0],x.nodeValue.length)
                            }
                            if(x.nodeType===1){
                                y=Math.min(t[0],x.childNodes.length)
                            }
                            if(z){
                                f.setStart(x,y)
                            }else{
                                f.setEnd(x,y)
                            }
                        }
                        return true
                    }
                    if(g(true)&&g()){
                        r.setRng(f)
                    }
                }else{
                    if(n.id){
                        function k(A){
                            var u=l.get(n.id+"_"+A),z,t,x,y,v=n.keep;
                            if(u){
                                z=u.parentNode;
                                if(A=="start"){
                                    if(!v){
                                        t=l.nodeIndex(u)
                                    }else{
                                        z=u.firstChild;
                                        t=1
                                    }
                                    j=s=z;
                                    o=p=t
                                }else{
                                    if(!v){
                                        t=l.nodeIndex(u)
                                    }else{
                                        z=u.firstChild;
                                        t=1
                                    }
                                    s=z;
                                    p=t
                                }
                                if(!v){
                                    y=u.previousSibling;
                                    x=u.nextSibling;
                                    d(c.grep(u.childNodes),function(B){
                                        if(B.nodeType==3){
                                            B.nodeValue=B.nodeValue.replace(/\uFEFF/g,"")
                                        }
                                    });
                                    while(u=l.get(n.id+"_"+A)){
                                        l.remove(u,1)
                                    }
                                    if(y&&x&&y.nodeType==x.nodeType&&y.nodeType==3&&!c.isOpera){
                                        t=y.nodeValue.length;
                                        y.appendData(x.nodeValue);
                                        l.remove(x);
                                        if(A=="start"){
                                            j=s=y;
                                            o=p=t
                                        }else{
                                            s=y;
                                            p=t
                                        }
                                    }
                                }
                            }
                        }
                        function m(t){
                            if(l.isBlock(t)&&!t.innerHTML){
                                t.innerHTML=!a?'<br data-mce-bogus="1" />':" "
                            }
                            return t
                        }
                        k("start");
                        k("end");
                        if(j){
                            f=l.createRng();
                            f.setStart(m(j),o);
                            f.setEnd(m(s),p);
                            r.setRng(f)
                        }
                    }else{
                        if(n.name){
                            r.select(l.select(n.name)[n.index])
                        }else{
                            if(n.rng){
                                r.setRng(n.rng)
                            }
                        }
                    }
                }
            }
        },
        select:function(k,j){
            var i=this,l=i.dom,g=l.createRng(),f;
            if(k){
                f=l.nodeIndex(k);
                g.setStart(k.parentNode,f);
                g.setEnd(k.parentNode,f+1);
                if(j){
                    function h(m,o){
                        var n=new c.dom.TreeWalker(m,m);
                        do{
                            if(m.nodeType==3&&c.trim(m.nodeValue).length!=0){
                                if(o){
                                    g.setStart(m,0)
                                }else{
                                    g.setEnd(m,m.nodeValue.length)
                                }
                                return
                            }
                            if(m.nodeName=="BR"){
                                if(o){
                                    g.setStartBefore(m)
                                }else{
                                    g.setEndBefore(m)
                                }
                                return
                            }
                        }while(m=(o?n.next():n.prev()))
                    }
                    h(k,1);
                    h(k)
                }
                i.setRng(g)
            }
            return k
        },
        isCollapsed:function(){
            var f=this,h=f.getRng(),g=f.getSel();
            if(!h||h.item){
                return false
            }
            if(h.compareEndPoints){
                return h.compareEndPoints("StartToEnd",h)===0
            }
            return !g||h.collapsed
        },
        collapse:function(f){
            var h=this,g=h.getRng(),i;
            if(g.item){
                i=g.item(0);
                g=h.win.document.body.createTextRange();
                g.moveToElementText(i)
            }
            g.collapse(!!f);
            h.setRng(g)
        },
        getSel:function(){
            var g=this,f=this.win;
            return f.getSelection?f.getSelection():f.document.selection
        },
        getRng:function(l){
            var g=this,h,i,k,j=g.win.document;
            if(l&&g.tridentSel){
                return g.tridentSel.getRangeAt(0)
            }
            try{
                if(h=g.getSel()){
                    i=h.rangeCount>0?h.getRangeAt(0):(h.createRange?h.createRange():j.createRange())
                }
            }catch(f){}
            if(c.isIE&&i&&i.setStart&&j.selection.createRange().item){
                k=j.selection.createRange().item(0);
                i=j.createRange();
                i.setStartBefore(k);
                i.setEndAfter(k)
            }
            if(!i){
                i=j.createRange?j.createRange():j.body.createTextRange()
            }
            if(g.selectedRange&&g.explicitRange){
                if(i.compareBoundaryPoints(i.START_TO_START,g.selectedRange)===0&&i.compareBoundaryPoints(i.END_TO_END,g.selectedRange)===0){
                    i=g.explicitRange
                }else{
                    g.selectedRange=null;
                    g.explicitRange=null
                }
            }
            return i
        },
        setRng:function(i){
            var h,g=this;
            if(!g.tridentSel){
                h=g.getSel();
                if(h){
                    g.explicitRange=i;
                    try{
                        h.removeAllRanges()
                    }catch(f){}
                    h.addRange(i);
                    g.selectedRange=h.getRangeAt(0)
                }
            }else{
                if(i.cloneRange){
                    g.tridentSel.addRange(i);
                    return
                }
                try{
                    i.select()
                }catch(f){}
            }
        },
        setNode:function(g){
            var f=this;
            f.setContent(f.dom.getOuterHTML(g));
            return g
        },
        getNode:function(){
            var h=this,g=h.getRng(),i=h.getSel(),l,k=g.startContainer,f=g.endContainer;
            if(!g){
                return h.dom.getRoot()
            }
            if(g.setStart){
                l=g.commonAncestorContainer;
                if(!g.collapsed){
                    if(g.startContainer==g.endContainer){
                        if(g.endOffset-g.startOffset<2){
                            if(g.startContainer.hasChildNodes()){
                                l=g.startContainer.childNodes[g.startOffset]
                            }
                        }
                    }
                    if(k.nodeType===3&&f.nodeType===3){
                        function j(p,m){
                            var o=p;
                            while(p&&p.nodeType===3&&p.length===0){
                                p=m?p.nextSibling:p.previousSibling
                            }
                            return p||o
                        }
                        if(k.length===g.startOffset){
                            k=j(k.nextSibling,true)
                        }else{
                            k=k.parentNode
                        }
                        if(g.endOffset===0){
                            f=j(f.previousSibling,false)
                        }else{
                            f=f.parentNode
                        }
                        if(k&&k===f){
                            return k
                        }
                    }
                }
                if(l&&l.nodeType==3){
                    return l.parentNode
                }
                return l
            }
            return g.item?g.item(0):g.parentElement()
        },
        getSelectedBlocks:function(g,f){
            var i=this,j=i.dom,m,h,l,k=[];
            m=j.getParent(g||i.getStart(),j.isBlock);
            h=j.getParent(f||i.getEnd(),j.isBlock);
            if(m){
                k.push(m)
            }
            if(m&&h&&m!=h){
                l=m;
                while((l=l.nextSibling)&&l!=h){
                    if(j.isBlock(l)){
                        k.push(l)
                    }
                }
            }
            if(h&&m!=h){
                k.push(h)
            }
            return k
        },
        destroy:function(g){
            var f=this;
            f.win=null;
            if(f.tridentSel){
                f.tridentSel.destroy()
            }
            if(!g){
                c.removeUnload(f.destroy)
            }
        },
        _fixIESelection:function(){
            var g=this.dom,m=g.doc,h=m.body,j,n,f;
            m.documentElement.unselectable=true;
            function i(o,r){
                var p=h.createTextRange();
                try{
                    p.moveToPoint(o,r)
                }catch(q){
                    p=null
                }
                return p
            }
            function l(p){
                var o;
                if(p.button){
                    o=i(p.x,p.y);
                    if(o){
                        if(o.compareEndPoints("StartToStart",n)>0){
                            o.setEndPoint("StartToStart",n)
                        }else{
                            o.setEndPoint("EndToEnd",n)
                        }
                        o.select()
                    }
                }else{
                    k()
                }
            }
            function k(){
                var o=m.selection.createRange();
                if(n&&!o.item&&o.compareEndPoints("StartToEnd",o)===0){
                    n.select()
                }
                g.unbind(m,"mouseup",k);
                g.unbind(m,"mousemove",l);
                n=j=0
            }
            g.bind(m,["mousedown","contextmenu"],function(o){
                if(o.target.nodeName==="HTML"){
                    if(j){
                        k()
                    }
                    f=m.documentElement;
                    if(f.scrollHeight>f.clientHeight){
                        return
                    }
                    j=1;
                    n=i(o.x,o.y);
                    if(n){
                        g.bind(m,"mouseup",k);
                        g.bind(m,"mousemove",l);
                        g.win.focus();
                        n.select()
                    }
                }
            })
        }
    })
})(tinymce);
(function(a){
    a.dom.Serializer=function(e,i,f){
        var h,b,d=a.isIE,g=a.each,c;
        if(!e.apply_source_formatting){
            e.indent=false
        }
        e.remove_trailing_brs=true;
        i=i||a.DOM;
        f=f||new a.html.Schema(e);
        e.entity_encoding=e.entity_encoding||"named";
        h=new a.util.Dispatcher(self);
        b=new a.util.Dispatcher(self);
        c=new a.html.DomParser(e,f);
        c.addAttributeFilter("src,href,style",function(k,j){
            var o=k.length,l,q,n="data-mce-"+j,p=e.url_converter,r=e.url_converter_scope,m;
            while(o--){
                l=k[o];
                q=l.attributes.map[n];
                if(q!==m){
                    l.attr(j,q.length>0?q:null);
                    l.attr(n,null)
                }else{
                    q=l.attributes.map[j];
                    if(j==="style"){
                        q=i.serializeStyle(i.parseStyle(q),l.name)
                    }else{
                        if(p){
                            q=p.call(r,q,j,l.name)
                        }
                    }
                    l.attr(j,q.length>0?q:null)
                }
            }
        });
        c.addAttributeFilter("class",function(j,k){
            var l=j.length,m,n;
            while(l--){
                m=j[l];
                n=m.attr("class").replace(/\s*mce(Item\w+|Selected)\s*/g,"");
                m.attr("class",n.length>0?n:null)
            }
        });
        c.addAttributeFilter("data-mce-type",function(j,l,k){
            var m=j.length,n;
            while(m--){
                n=j[m];
                if(n.attributes.map["data-mce-type"]==="bookmark"&&!k.cleanup){
                    n.remove()
                }
            }
        });
        c.addNodeFilter("script,style",function(k,l){
            var m=k.length,n,o;
            function j(p){
                return p.replace(/(<!--\[CDATA\[|\]\]-->)/g,"\n").replace(/^[\r\n]*|[\r\n]*$/g,"").replace(/^\s*(\/\/\s*<!--|\/\/\s*<!\[CDATA\[|<!--|<!\[CDATA\[)[\r\n]*/g,"").replace(/\s*(\/\/\s*\]\]>|\/\/\s*-->|\]\]>|-->|\]\]-->)\s*$/g,"")
            }while(m--){
                n=k[m];
                o=n.firstChild?n.firstChild.value:"";
                if(l==="script"){
                    n.attr("type",(n.attr("type")||"text/javascript").replace(/^mce\-/,""));
                    if(o.length>0){
                        n.firstChild.value="// <![CDATA[\n"+j(o)+"\n// ]]>"
                    }
                }else{
                    if(o.length>0){
                        n.firstChild.value="<!--\n"+j(o)+"\n-->"
                    }
                }
            }
        });
        c.addNodeFilter("#comment",function(j,k){
            var l=j.length,m;
            while(l--){
                m=j[l];
                if(m.value.indexOf("[CDATA[")===0){
                    m.name="#cdata";
                    m.type=4;
                    m.value=m.value.replace(/^\[CDATA\[|\]\]$/g,"")
                }else{
                    if(m.value.indexOf("mce:protected ")===0){
                        m.name="#text";
                        m.type=3;
                        m.raw=true;
                        m.value=unescape(m.value).substr(14)
                    }
                }
            }
        });
        c.addNodeFilter("xml:namespace,input",function(j,k){
            var l=j.length,m;
            while(l--){
                m=j[l];
                if(m.type===7){
                    m.remove()
                }else{
                    if(m.type===1){
                        if(k==="input"&&!("type" in m.attributes.map)){
                            m.attr("type","text")
                        }
                    }
                }
            }
        });
        if(e.fix_list_elements){
            c.addNodeFilter("ul,ol",function(k,l){
                var m=k.length,n,j;
                while(m--){
                    n=k[m];
                    j=n.parent;
                    if(j.name==="ul"||j.name==="ol"){
                        if(n.prev&&n.prev.name==="li"){
                            n.prev.append(n)
                        }
                    }
                }
            })
        }
        c.addAttributeFilter("data-mce-src,data-mce-href,data-mce-style",function(j,k){
            var l=j.length;
            while(l--){
                j[l].attr(k,null)
            }
        });
        return{
            schema:f,
            addNodeFilter:c.addNodeFilter,
            addAttributeFilter:c.addAttributeFilter,
            onPreProcess:h,
            onPostProcess:b,
            serialize:function(o,m){
                var l,p,k,j,n;
                if(d&&i.select("script,style,select").length>0){
                    n=o.innerHTML;
                    o=o.cloneNode(false);
                    i.setHTML(o,n)
                }else{
                    o=o.cloneNode(true)
                }
                l=o.ownerDocument.implementation;
                if(l.createHTMLDocument){
                    p=l.createHTMLDocument("");
                    g(o.nodeName=="BODY"?o.childNodes:[o],function(q){
                        p.body.appendChild(p.importNode(q,true))
                    });
                    if(o.nodeName!="BODY"){
                        o=p.body.firstChild
                    }else{
                        o=p.body
                    }
                    k=i.doc;
                    i.doc=p
                }
                m=m||{};
        
                m.format=m.format||"html";
                if(!m.no_events){
                    m.node=o;
                    h.dispatch(self,m)
                }
                j=new a.html.Serializer(e,f);
                m.content=j.serialize(c.parse(m.getInner?o.innerHTML:a.trim(i.getOuterHTML(o),m),m));
                if(!m.cleanup){
                    m.content=m.content.replace(/\uFEFF/g,"")
                }
                if(!m.no_events){
                    b.dispatch(self,m)
                }
                if(k){
                    i.doc=k
                }
                m.node=null;
                return m.content
            },
            addRules:function(j){
                f.addValidElements(j)
            },
            setRules:function(j){
                f.setValidElements(j)
            }
        }
    }
})(tinymce);
(function(a){
    a.dom.ScriptLoader=function(h){
        var c=0,k=1,i=2,l={},j=[],f={},d=[],g=0,e;
        function b(m,v){
            var x=this,q=a.DOM,s,o,r,n;
            function p(){
                q.remove(n);
                if(s){
                    s.onreadystatechange=s.onload=s=null
                }
                v()
            }
            function u(){
                if(typeof(console)!=="undefined"&&console.log){
                    console.log("Failed to load: "+m)
                }
            }
            n=q.uniqueId();
            if(a.isIE6){
                o=new a.util.URI(m);
                r=location;
                if(o.host==r.hostname&&o.port==r.port&&(o.protocol+":")==r.protocol&&o.protocol.toLowerCase()!="file"){
                    a.util.XHR.send({
                        url:a._addVer(o.getURI()),
                        success:function(y){
                            var t=q.create("script",{
                                type:"text/javascript"
                            });
                            t.text=y;
                            document.getElementsByTagName("head")[0].appendChild(t);
                            q.remove(t);
                            p()
                        },
                        error:u
                    });
                    return
                }
            }
            s=q.create("script",{
                id:n,
                type:"text/javascript",
                src:a._addVer(m)
            });
            if(!a.isIE){
                s.onload=p
            }
            s.onerror=u;
            if(!a.isOpera){
                s.onreadystatechange=function(){
                    var t=s.readyState;
                    if(t=="complete"||t=="loaded"){
                        p()
                    }
                }
            }(document.getElementsByTagName("head")[0]||document.body).appendChild(s)
        }
        this.isDone=function(m){
            return l[m]==i
        };
    
        this.markDone=function(m){
            l[m]=i
        };
    
        this.add=this.load=function(m,q,n){
            var o,p=l[m];
            if(p==e){
                j.push(m);
                l[m]=c
            }
            if(q){
                if(!f[m]){
                    f[m]=[]
                }
                f[m].push({
                    func:q,
                    scope:n||this
                })
            }
        };

        this.loadQueue=function(n,m){
            this.loadScripts(j,n,m)
        };
    
        this.loadScripts=function(m,q,p){
            var o;
            function n(r){
                a.each(f[r],function(s){
                    s.func.call(s.scope)
                });
                f[r]=e
            }
            d.push({
                func:q,
                scope:p||this
            });
            o=function(){
                var r=a.grep(m);
                m.length=0;
                a.each(r,function(s){
                    if(l[s]==i){
                        n(s);
                        return
                    }
                    if(l[s]!=k){
                        l[s]=k;
                        g++;
                        b(s,function(){
                            l[s]=i;
                            g--;
                            n(s);
                            o()
                        })
                    }
                });
                if(!g){
                    a.each(d,function(s){
                        s.func.call(s.scope)
                    });
                    d.length=0
                }
            };

            o()
        }
    };

    a.ScriptLoader=new a.dom.ScriptLoader()
})(tinymce);
tinymce.dom.TreeWalker=function(a,c){
    var b=a;
    function d(i,f,e,j){
        var h,g;
        if(i){
            if(!j&&i[f]){
                return i[f]
            }
            if(i!=c){
                h=i[e];
                if(h){
                    return h
                }
                for(g=i.parentNode;g&&g!=c;g=g.parentNode){
                    h=g[e];
                    if(h){
                        return h
                    }
                }
            }
        }
    }
    this.current=function(){
        return b
    };
    
    this.next=function(e){
        return(b=d(b,"firstChild","nextSibling",e))
    };
    
    this.prev=function(e){
        return(b=d(b,"lastChild","previousSibling",e))
    }
};
(function(a){
    a.dom.RangeUtils=function(c){
        var b="\uFEFF";
        this.walk=function(d,r){
            var h=d.startContainer,k=d.startOffset,s=d.endContainer,l=d.endOffset,i,f,n,g,q,p,e;
            e=c.select("td.mceSelected,th.mceSelected");
            if(e.length>0){
                a.each(e,function(t){
                    r([t])
                });
                return
            }
            function o(v,u,t){
                var x=[];
                for(;v&&v!=t;v=v[u]){
                    x.push(v)
                }
                return x
            }
            function m(u,t){
                do{
                    if(u.parentNode==t){
                        return u
                    }
                    u=u.parentNode
                }while(u)
            }
            function j(v,u,x){
                var t=x?"nextSibling":"previousSibling";
                for(g=v,q=g.parentNode;g&&g!=u;g=q){
                    q=g.parentNode;
                    p=o(g==v?g:g[t],t);
                    if(p.length){
                        if(!x){
                            p.reverse()
                        }
                        r(p)
                    }
                }
            }
            if(h.nodeType==1&&h.hasChildNodes()){
                h=h.childNodes[k]
            }
            if(s.nodeType==1&&s.hasChildNodes()){
                s=s.childNodes[Math.min(l-1,s.childNodes.length-1)]
            }
            i=c.findCommonAncestor(h,s);
            if(h==s){
                return r([h])
            }
            for(g=h;g;g=g.parentNode){
                if(g==s){
                    return j(h,i,true)
                }
                if(g==i){
                    break
                }
            }
            for(g=s;g;g=g.parentNode){
                if(g==h){
                    return j(s,i)
                }
                if(g==i){
                    break
                }
            }
            f=m(h,i)||h;
            n=m(s,i)||s;
            j(h,f,true);
            p=o(f==h?f:f.nextSibling,"nextSibling",n==s?n.nextSibling:n);
            if(p.length){
                r(p)
            }
            j(s,n)
        }
    };

    a.dom.RangeUtils.compareRanges=function(c,b){
        if(c&&b){
            if(c.item||c.duplicate){
                if(c.item&&b.item&&c.item(0)===b.item(0)){
                    return true
                }
                if(c.isEqual&&b.isEqual&&b.isEqual(c)){
                    return true
                }
            }else{
                return c.startContainer==b.startContainer&&c.startOffset==b.startOffset
            }
        }
        return false
    }
})(tinymce);
(function(b){
    var a=b.dom.Event,c=b.each;
    b.create("tinymce.ui.KeyboardNavigation",{
        KeyboardNavigation:function(e,f){
            var p=this,m=e.root,l=e.items,n=e.enableUpDown,i=e.enableLeftRight||!e.enableUpDown,k=e.excludeFromTabOrder,j,h,o,d,g;
            f=f||b.DOM;
            j=function(q){
                g=q.target.id
            };
                
            h=function(q){
                f.setAttrib(q.target.id,"tabindex","-1")
            };
                
            d=function(q){
                var r=f.get(g);
                f.setAttrib(r,"tabindex","0");
                r.focus()
            };
                
            p.focus=function(){
                f.get(g).focus()
            };
                
            p.destroy=function(){
                c(l,function(q){
                    f.unbind(f.get(q.id),"focus",j);
                    f.unbind(f.get(q.id),"blur",h)
                });
                f.unbind(f.get(m),"focus",d);
                f.unbind(f.get(m),"keydown",o);
                l=f=m=p.focus=j=h=o=d=null;
                p.destroy=function(){}
            };
            
            p.moveFocus=function(u,r){
                var q=-1,t=p.controls,s;
                if(!g){
                    return
                }
                c(l,function(x,v){
                    if(x.id===g){
                        q=v;
                        return false
                    }
                });
                q+=u;
                if(q<0){
                    q=l.length-1
                }else{
                    if(q>=l.length){
                        q=0
                    }
                }
                s=l[q];
                f.setAttrib(g,"tabindex","-1");
                f.setAttrib(s.id,"tabindex","0");
                f.get(s.id).focus();
                if(e.actOnFocus){
                    e.onAction(s.id)
                }
                if(r){
                    a.cancel(r)
                }
            };
    
            o=function(y){
                var u=37,t=39,x=38,z=40,q=27,s=14,r=13,v=32;
                switch(y.keyCode){
                    case u:
                        if(i){
                            p.moveFocus(-1)
                        }
                        break;
                    case t:
                        if(i){
                            p.moveFocus(1)
                        }
                        break;
                    case x:
                        if(n){
                            p.moveFocus(-1)
                        }
                        break;
                    case z:
                        if(n){
                            p.moveFocus(1)
                        }
                        break;
                    case q:
                        if(e.onCancel){
                            e.onCancel();
                            a.cancel(y)
                        }
                        break;
                    case s:case r:case v:
                        if(e.onAction){
                            e.onAction(g);
                            a.cancel(y)
                        }
                        break
                }
            };

            c(l,function(s,q){
                var r;
                if(!s.id){
                    s.id=f.uniqueId("_mce_item_")
                }
                if(k){
                    f.bind(s.id,"blur",h);
                    r="-1"
                }else{
                    r=(q===0?"0":"-1")
                }
                f.setAttrib(s.id,"tabindex",r);
                f.bind(f.get(s.id),"focus",j)
            });
            if(l[0]){
                g=l[0].id
            }
            f.setAttrib(m,"tabindex","-1");
            f.bind(f.get(m),"focus",d);
            f.bind(f.get(m),"keydown",o)
        }
    })
})(tinymce);
(function(c){
    var b=c.DOM,a=c.is;
    c.create("tinymce.ui.Control",{
        Control:function(f,e,d){
            this.id=f;
            this.settings=e=e||{};
            
            this.rendered=false;
            this.onRender=new c.util.Dispatcher(this);
            this.classPrefix="";
            this.scope=e.scope||this;
            this.disabled=0;
            this.active=0;
            this.editor=d
        },
        setAriaProperty:function(f,e){
            var d=b.get(this.id+"_aria")||b.get(this.id);
            if(d){
                b.setAttrib(d,"aria-"+f,!!e)
            }
        },
        focus:function(){
            b.get(this.id).focus()
        },
        setDisabled:function(d){
            if(d!=this.disabled){
                this.setAriaProperty("disabled",d);
                this.setState("Disabled",d);
                this.setState("Enabled",!d);
                this.disabled=d
            }
        },
        isDisabled:function(){
            return this.disabled
        },
        setActive:function(d){
            if(d!=this.active){
                this.setState("Active",d);
                this.active=d;
                this.setAriaProperty("pressed",d)
            }
        },
        isActive:function(){
            return this.active
        },
        setState:function(f,d){
            var e=b.get(this.id);
            f=this.classPrefix+f;
            if(d){
                b.addClass(e,f)
            }else{
                b.removeClass(e,f)
            }
        },
        isRendered:function(){
            return this.rendered
        },
        renderHTML:function(){},
        renderTo:function(d){
            b.setHTML(d,this.renderHTML())
        },
        postRender:function(){
            var e=this,d;
            if(a(e.disabled)){
                d=e.disabled;
                e.disabled=-1;
                e.setDisabled(d)
            }
            if(a(e.active)){
                d=e.active;
                e.active=-1;
                e.setActive(d)
            }
        },
        remove:function(){
            b.remove(this.id);
            this.destroy()
        },
        destroy:function(){
            c.dom.Event.clear(this.id)
        }
    })
})(tinymce);
tinymce.create("tinymce.ui.Container:tinymce.ui.Control",{
    Container:function(c,b,a){
        this.parent(c,b,a);
        this.controls=[];
        this.lookup={}
    },
    add:function(a){
        this.lookup[a.id]=a;
        this.controls.push(a);
        return a
    },
    get:function(a){
        return this.lookup[a]
    }
});
tinymce.create("tinymce.ui.Separator:tinymce.ui.Control",{
    Separator:function(b,a){
        this.parent(b,a);
        this.classPrefix="mceSeparator";
        this.setDisabled(true)
    },
    renderHTML:function(){
        return tinymce.DOM.createHTML("span",{
            "class":this.classPrefix,
            role:"separator",
            "aria-orientation":"vertical",
            tabindex:"-1"
        })
    }
});
(function(d){
    var c=d.is,b=d.DOM,e=d.each,a=d.walk;
    d.create("tinymce.ui.MenuItem:tinymce.ui.Control",{
        MenuItem:function(g,f){
            this.parent(g,f);
            this.classPrefix="mceMenuItem"
        },
        setSelected:function(f){
            this.setState("Selected",f);
            this.setAriaProperty("checked",!!f);
            this.selected=f
        },
        isSelected:function(){
            return this.selected
        },
        postRender:function(){
            var f=this;
            f.parent();
            if(c(f.selected)){
                f.setSelected(f.selected)
            }
        }
    })
})(tinymce);
(function(d){
    var c=d.is,b=d.DOM,e=d.each,a=d.walk;
    d.create("tinymce.ui.Menu:tinymce.ui.MenuItem",{
        Menu:function(h,g){
            var f=this;
            f.parent(h,g);
            f.items={};
            
            f.collapsed=false;
            f.menuCount=0;
            f.onAddItem=new d.util.Dispatcher(this)
        },
        expand:function(g){
            var f=this;
            if(g){
                a(f,function(h){
                    if(h.expand){
                        h.expand()
                    }
                },"items",f)
            }
            f.collapsed=false
        },
        collapse:function(g){
            var f=this;
            if(g){
                a(f,function(h){
                    if(h.collapse){
                        h.collapse()
                    }
                },"items",f)
            }
            f.collapsed=true
        },
        isCollapsed:function(){
            return this.collapsed
        },
        add:function(f){
            if(!f.settings){
                f=new d.ui.MenuItem(f.id||b.uniqueId(),f)
            }
            this.onAddItem.dispatch(this,f);
            return this.items[f.id]=f
        },
        addSeparator:function(){
            return this.add({
                separator:true
            })
        },
        addMenu:function(f){
            if(!f.collapse){
                f=this.createMenu(f)
            }
            this.menuCount++;
            return this.add(f)
        },
        hasMenus:function(){
            return this.menuCount!==0
        },
        remove:function(f){
            delete this.items[f.id]
        },
        removeAll:function(){
            var f=this;
            a(f,function(g){
                if(g.removeAll){
                    g.removeAll()
                }else{
                    g.remove()
                }
                g.destroy()
            },"items",f);
            f.items={}
        },
        createMenu:function(g){
            var f=new d.ui.Menu(g.id||b.uniqueId(),g);
            f.onAddItem.add(this.onAddItem.dispatch,this.onAddItem);
            return f
        }
    })
})(tinymce);
(function(e){
    var d=e.is,c=e.DOM,f=e.each,a=e.dom.Event,b=e.dom.Element;
    e.create("tinymce.ui.DropMenu:tinymce.ui.Menu",{
        DropMenu:function(h,g){
            g=g||{};
            
            g.container=g.container||c.doc.body;
            g.offset_x=g.offset_x||0;
            g.offset_y=g.offset_y||0;
            g.vp_offset_x=g.vp_offset_x||0;
            g.vp_offset_y=g.vp_offset_y||0;
            if(d(g.icons)&&!g.icons){
                g["class"]+=" mceNoIcons"
            }
            this.parent(h,g);
            this.onShowMenu=new e.util.Dispatcher(this);
            this.onHideMenu=new e.util.Dispatcher(this);
            this.classPrefix="mceMenu"
        },
        createMenu:function(j){
            var h=this,i=h.settings,g;
            j.container=j.container||i.container;
            j.parent=h;
            j.constrain=j.constrain||i.constrain;
            j["class"]=j["class"]||i["class"];
            j.vp_offset_x=j.vp_offset_x||i.vp_offset_x;
            j.vp_offset_y=j.vp_offset_y||i.vp_offset_y;
            j.keyboard_focus=i.keyboard_focus;
            g=new e.ui.DropMenu(j.id||c.uniqueId(),j);
            g.onAddItem.add(h.onAddItem.dispatch,h.onAddItem);
            return g
        },
        focus:function(){
            var g=this;
            if(g.keyboardNav){
                g.keyboardNav.focus()
            }
        },
        update:function(){
            var i=this,j=i.settings,g=c.get("menu_"+i.id+"_tbl"),l=c.get("menu_"+i.id+"_co"),h,k;
            h=j.max_width?Math.min(g.clientWidth,j.max_width):g.clientWidth;
            k=j.max_height?Math.min(g.clientHeight,j.max_height):g.clientHeight;
            if(!c.boxModel){
                i.element.setStyles({
                    width:h+2,
                    height:k+2
                })
            }else{
                i.element.setStyles({
                    width:h,
                    height:k
                })
            }
            if(j.max_width){
                c.setStyle(l,"width",h)
            }
            if(j.max_height){
                c.setStyle(l,"height",k);
                if(g.clientHeight<j.max_height){
                    c.setStyle(l,"overflow","hidden")
                }
            }
        },
        showMenu:function(p,n,r){
            var z=this,A=z.settings,o,g=c.getViewPort(),u,l,v,q,i=2,k,j,m=z.classPrefix;
            z.collapse(1);
            if(z.isMenuVisible){
                return
            }
            if(!z.rendered){
                o=c.add(z.settings.container,z.renderNode());
                f(z.items,function(h){
                    h.postRender()
                });
                z.element=new b("menu_"+z.id,{
                    blocker:1,
                    container:A.container
                })
            }else{
                o=c.get("menu_"+z.id)
            }
            if(!e.isOpera){
                c.setStyles(o,{
                    left:-65535,
                    top:-65535
                })
            }
            c.show(o);
            z.update();
            p+=A.offset_x||0;
            n+=A.offset_y||0;
            g.w-=4;
            g.h-=4;
            if(A.constrain){
                u=o.clientWidth-i;
                l=o.clientHeight-i;
                v=g.x+g.w;
                q=g.y+g.h;
                if((p+A.vp_offset_x+u)>v){
                    p=r?r-u:Math.max(0,(v-A.vp_offset_x)-u)
                }
                if((n+A.vp_offset_y+l)>q){
                    n=Math.max(0,(q-A.vp_offset_y)-l)
                }
            }
            c.setStyles(o,{
                left:p,
                top:n
            });
            z.element.update();
            z.isMenuVisible=1;
            z.mouseClickFunc=a.add(o,"click",function(s){
                var h;
                s=s.target;
                if(s&&(s=c.getParent(s,"tr"))&&!c.hasClass(s,m+"ItemSub")){
                    h=z.items[s.id];
                    if(h.isDisabled()){
                        return
                    }
                    k=z;
                    while(k){
                        if(k.hideMenu){
                            k.hideMenu()
                        }
                        k=k.settings.parent
                    }
                    if(h.settings.onclick){
                        h.settings.onclick(s)
                    }
                    return a.cancel(s)
                }
            });
            if(z.hasMenus()){
                z.mouseOverFunc=a.add(o,"mouseover",function(x){
                    var h,t,s;
                    x=x.target;
                    if(x&&(x=c.getParent(x,"tr"))){
                        h=z.items[x.id];
                        if(z.lastMenu){
                            z.lastMenu.collapse(1)
                        }
                        if(h.isDisabled()){
                            return
                        }
                        if(x&&c.hasClass(x,m+"ItemSub")){
                            t=c.getRect(x);
                            h.showMenu((t.x+t.w-i),t.y-i,t.x);
                            z.lastMenu=h;
                            c.addClass(c.get(h.id).firstChild,m+"ItemActive")
                        }
                    }
                })
            }
            a.add(o,"keydown",z._keyHandler,z);
            z.onShowMenu.dispatch(z);
            if(A.keyboard_focus){
                z._setupKeyboardNav()
            }
        },
        hideMenu:function(j){
            var g=this,i=c.get("menu_"+g.id),h;
            if(!g.isMenuVisible){
                return
            }
            if(g.keyboardNav){
                g.keyboardNav.destroy()
            }
            a.remove(i,"mouseover",g.mouseOverFunc);
            a.remove(i,"click",g.mouseClickFunc);
            a.remove(i,"keydown",g._keyHandler);
            c.hide(i);
            g.isMenuVisible=0;
            if(!j){
                g.collapse(1)
            }
            if(g.element){
                g.element.hide()
            }
            if(h=c.get(g.id)){
                c.removeClass(h.firstChild,g.classPrefix+"ItemActive")
            }
            g.onHideMenu.dispatch(g)
        },
        add:function(i){
            var g=this,h;
            i=g.parent(i);
            if(g.isRendered&&(h=c.get("menu_"+g.id))){
                g._add(c.select("tbody",h)[0],i)
            }
            return i
        },
        collapse:function(g){
            this.parent(g);
            this.hideMenu(1)
        },
        remove:function(g){
            c.remove(g.id);
            this.destroy();
            return this.parent(g)
        },
        destroy:function(){
            var g=this,h=c.get("menu_"+g.id);
            if(g.keyboardNav){
                g.keyboardNav.destroy()
            }
            a.remove(h,"mouseover",g.mouseOverFunc);
            a.remove(c.select("a",h),"focus",g.mouseOverFunc);
            a.remove(h,"click",g.mouseClickFunc);
            a.remove(h,"keydown",g._keyHandler);
            if(g.element){
                g.element.remove()
            }
            c.remove(h)
        },
        renderNode:function(){
            var i=this,j=i.settings,l,h,k,g;
            g=c.create("div",{
                role:"listbox",
                id:"menu_"+i.id,
                "class":j["class"],
                style:"position:absolute;left:0;top:0;z-index:200000;outline:0"
            });
            if(i.settings.parent){
                c.setAttrib(g,"aria-parent","menu_"+i.settings.parent.id)
            }
            k=c.add(g,"div",{
                role:"presentation",
                id:"menu_"+i.id+"_co",
                "class":i.classPrefix+(j["class"]?" "+j["class"]:"")
            });
            i.element=new b("menu_"+i.id,{
                blocker:1,
                container:j.container
            });
            if(j.menu_line){
                c.add(k,"span",{
                    "class":i.classPrefix+"Line"
                })
            }
            l=c.add(k,"table",{
                role:"presentation",
                id:"menu_"+i.id+"_tbl",
                border:0,
                cellPadding:0,
                cellSpacing:0
            });
            h=c.add(l,"tbody");
            f(i.items,function(m){
                i._add(h,m)
            });
            i.rendered=true;
            return g
        },
        _setupKeyboardNav:function(){
            var i,h,g=this;
            i=c.select("#menu_"+g.id)[0];
            h=c.select("a[role=option]","menu_"+g.id);
            h.splice(0,0,i);
            g.keyboardNav=new e.ui.KeyboardNavigation({
                root:"menu_"+g.id,
                items:h,
                onCancel:function(){
                    g.hideMenu()
                },
                enableUpDown:true
            });
            i.focus()
        },
        _keyHandler:function(g){
            var h=this,i;
            switch(g.keyCode){
                case 37:
                    if(h.settings.parent){
                        h.hideMenu();
                        h.settings.parent.focus();
                        a.cancel(g)
                    }
                    break;
                case 39:
                    if(h.mouseOverFunc){
                        h.mouseOverFunc(g)
                    }
                    break
            }
        },
        _add:function(j,h){
            var i,q=h.settings,p,l,k,m=this.classPrefix,g;
            if(q.separator){
                l=c.add(j,"tr",{
                    id:h.id,
                    "class":m+"ItemSeparator"
                });
                c.add(l,"td",{
                    "class":m+"ItemSeparator"
                });
                if(i=l.previousSibling){
                    c.addClass(i,"mceLast")
                }
                return
            }
            i=l=c.add(j,"tr",{
                id:h.id,
                "class":m+"Item "+m+"ItemEnabled"
            });
            i=k=c.add(i,q.titleItem?"th":"td");
            i=p=c.add(i,"a",{
                id:h.id+"_aria",
                role:q.titleItem?"presentation":"option",
                href:"javascript:;",
                onclick:"return false;",
                onmousedown:"return false;"
            });
            if(q.parent){
                c.setAttrib(p,"aria-haspopup","true");
                c.setAttrib(p,"aria-owns","menu_"+h.id)
            }
            c.addClass(k,q["class"]);
            g=c.add(i,"span",{
                "class":"mceIcon"+(q.icon?" mce_"+q.icon:"")
            });
            if(q.icon_src){
                c.add(g,"img",{
                    src:q.icon_src
                })
            }
            i=c.add(i,q.element||"span",{
                "class":"mceText",
                title:h.settings.title
            },h.settings.title);
            if(h.settings.style){
                c.setAttrib(i,"style",h.settings.style)
            }
            if(j.childNodes.length==1){
                c.addClass(l,"mceFirst")
            }
            if((i=l.previousSibling)&&c.hasClass(i,m+"ItemSeparator")){
                c.addClass(l,"mceFirst")
            }
            if(h.collapse){
                c.addClass(l,m+"ItemSub")
            }
            if(i=l.previousSibling){
                c.removeClass(i,"mceLast")
            }
            c.addClass(l,"mceLast")
        }
    })
})(tinymce);
(function(b){
    var a=b.DOM;
    b.create("tinymce.ui.Button:tinymce.ui.Control",{
        Button:function(e,d,c){
            this.parent(e,d,c);
            this.classPrefix="mceButton"
        },
        renderHTML:function(){
            var f=this.classPrefix,e=this.settings,d,c;
            c=a.encode(e.label||"");
            d='<a role="button" id="'+this.id+'" href="javascript:;" class="'+f+" "+f+"Enabled "+e["class"]+(c?" "+f+"Labeled":"")+'" onmousedown="return false;" onclick="return false;" aria-labelledby="'+this.id+'_voice" title="'+a.encode(e.title)+'">';
            if(e.image){
                d+='<img class="mceIcon" src="'+e.image+'" alt="'+a.encode(e.title)+'" />'+c
            }else{
                d+='<span class="mceIcon '+e["class"]+'"></span>'+(c?'<span class="'+f+'Label">'+c+"</span>":"")
            }
            d+='<span class="mceVoiceLabel mceIconOnly" style="display: none;" id="'+this.id+'_voice">'+e.title+"</span>";
            d+="</a>";
            return d
        },
        postRender:function(){
            var c=this,d=c.settings;
            b.dom.Event.add(c.id,"click",function(f){
                if(!c.isDisabled()){
                    return d.onclick.call(d.scope,f)
                }
            })
        }
    })
})(tinymce);
(function(d){
    var c=d.DOM,b=d.dom.Event,e=d.each,a=d.util.Dispatcher;
    d.create("tinymce.ui.ListBox:tinymce.ui.Control",{
        ListBox:function(i,h,f){
            var g=this;
            g.parent(i,h,f);
            g.items=[];
            g.onChange=new a(g);
            g.onPostRender=new a(g);
            g.onAdd=new a(g);
            g.onRenderMenu=new d.util.Dispatcher(this);
            g.classPrefix="mceListBox"
        },
        select:function(h){
            var g=this,j,i;
            if(h==undefined){
                return g.selectByIndex(-1)
            }
            if(h&&h.call){
                i=h
            }else{
                i=function(f){
                    return f==h
                }
            }
            if(h!=g.selectedValue){
                e(g.items,function(k,f){
                    if(i(k.value)){
                        j=1;
                        g.selectByIndex(f);
                        return false
                    }
                });
                if(!j){
                    g.selectByIndex(-1)
                }
            }
        },
        selectByIndex:function(f){
            var g=this,h,i;
            if(f!=g.selectedIndex){
                h=c.get(g.id+"_text");
                i=g.items[f];
                if(i){
                    g.selectedValue=i.value;
                    g.selectedIndex=f;
                    c.setHTML(h,c.encode(i.title));
                    c.removeClass(h,"mceTitle");
                    c.setAttrib(g.id,"aria-valuenow",i.title)
                }else{
                    c.setHTML(h,c.encode(g.settings.title));
                    c.addClass(h,"mceTitle");
                    g.selectedValue=g.selectedIndex=null;
                    c.setAttrib(g.id,"aria-valuenow",g.settings.title)
                }
                h=0
            }
        },
        add:function(i,f,h){
            var g=this;
            h=h||{};
    
            h=d.extend(h,{
                title:i,
                value:f
            });
            g.items.push(h);
            g.onAdd.dispatch(g,h)
        },
        getLength:function(){
            return this.items.length
        },
        renderHTML:function(){
            var i="",f=this,g=f.settings,j=f.classPrefix;
            i='<span role="button" aria-haspopup="true" aria-labelledby="'+f.id+'_text" aria-describedby="'+f.id+'_voiceDesc"><table role="presentation" tabindex="0" id="'+f.id+'" cellpadding="0" cellspacing="0" class="'+j+" "+j+"Enabled"+(g["class"]?(" "+g["class"]):"")+'"><tbody><tr>';
            i+="<td>"+c.createHTML("span",{
                id:f.id+"_voiceDesc",
                "class":"voiceLabel",
                style:"display:none;"
            },f.settings.title);
            i+=c.createHTML("a",{
                id:f.id+"_text",
                tabindex:-1,
                href:"javascript:;",
                "class":"mceText",
                onclick:"return false;",
                onmousedown:"return false;"
            },c.encode(f.settings.title))+"</td>";
            i+="<td>"+c.createHTML("a",{
                id:f.id+"_open",
                tabindex:-1,
                href:"javascript:;",
                "class":"mceOpen",
                onclick:"return false;",
                onmousedown:"return false;"
            },'<span><span style="display:none;" class="mceIconOnly" aria-hidden="true">\u25BC</span></span>')+"</td>";
            i+="</tr></tbody></table></span>";
            return i
        },
        showMenu:function(){
            var g=this,j,i,h=c.get(this.id),f;
            if(g.isDisabled()||g.items.length==0){
                return
            }
            if(g.menu&&g.menu.isMenuVisible){
                return g.hideMenu()
            }
            if(!g.isMenuRendered){
                g.renderMenu();
                g.isMenuRendered=true
            }
            j=c.getPos(this.settings.menu_container);
            i=c.getPos(h);
            f=g.menu;
            f.settings.offset_x=i.x;
            f.settings.offset_y=i.y;
            f.settings.keyboard_focus=!d.isOpera;
            if(g.oldID){
                f.items[g.oldID].setSelected(0)
            }
            e(g.items,function(k){
                if(k.value===g.selectedValue){
                    f.items[k.id].setSelected(1);
                    g.oldID=k.id
                }
            });
            f.showMenu(0,h.clientHeight);
            b.add(c.doc,"mousedown",g.hideMenu,g);
            c.addClass(g.id,g.classPrefix+"Selected")
        },
        hideMenu:function(g){
            var f=this;
            if(f.menu&&f.menu.isMenuVisible){
                c.removeClass(f.id,f.classPrefix+"Selected");
                if(g&&g.type=="mousedown"&&(g.target.id==f.id+"_text"||g.target.id==f.id+"_open")){
                    return
                }
                if(!g||!c.getParent(g.target,".mceMenu")){
                    c.removeClass(f.id,f.classPrefix+"Selected");
                    b.remove(c.doc,"mousedown",f.hideMenu,f);
                    f.menu.hideMenu()
                }
            }
        },
        renderMenu:function(){
            var g=this,f;
            f=g.settings.control_manager.createDropMenu(g.id+"_menu",{
                menu_line:1,
                "class":g.classPrefix+"Menu mceNoIcons",
                max_width:150,
                max_height:150
            });
            f.onHideMenu.add(function(){
                g.hideMenu();
                g.focus()
            });
            f.add({
                title:g.settings.title,
                "class":"mceMenuItemTitle",
                onclick:function(){
                    if(g.settings.onselect("")!==false){
                        g.select("")
                    }
                }
            });
            e(g.items,function(h){
                if(h.value===undefined){
                    f.add({
                        title:h.title,
                        "class":"mceMenuItemTitle",
                        onclick:function(){
                            if(g.settings.onselect("")!==false){
                                g.select("")
                            }
                        }
                    })
                }else{
                    h.id=c.uniqueId();
                    h.onclick=function(){
                        if(g.settings.onselect(h.value)!==false){
                            g.select(h.value)
                        }
                    };
    
                    f.add(h)
                }
            });
            g.onRenderMenu.dispatch(g,f);
            g.menu=f
        },
        postRender:function(){
            var f=this,g=f.classPrefix;
            b.add(f.id,"click",f.showMenu,f);
            b.add(f.id,"keydown",function(h){
                if(h.keyCode==32){
                    f.showMenu(h);
                    b.cancel(h)
                }
            });
            b.add(f.id,"focus",function(){
                if(!f._focused){
                    f.keyDownHandler=b.add(f.id,"keydown",function(h){
                        if(h.keyCode==40){
                            f.showMenu();
                            b.cancel(h)
                        }
                    });
                    f.keyPressHandler=b.add(f.id,"keypress",function(i){
                        var h;
                        if(i.keyCode==13){
                            h=f.selectedValue;
                            f.selectedValue=null;
                            b.cancel(i);
                            f.settings.onselect(h)
                        }
                    })
                }
                f._focused=1
            });
            b.add(f.id,"blur",function(){
                b.remove(f.id,"keydown",f.keyDownHandler);
                b.remove(f.id,"keypress",f.keyPressHandler);
                f._focused=0
            });
            if(d.isIE6||!c.boxModel){
                b.add(f.id,"mouseover",function(){
                    if(!c.hasClass(f.id,g+"Disabled")){
                        c.addClass(f.id,g+"Hover")
                    }
                });
                b.add(f.id,"mouseout",function(){
                    if(!c.hasClass(f.id,g+"Disabled")){
                        c.removeClass(f.id,g+"Hover")
                    }
                })
            }
            f.onPostRender.dispatch(f,c.get(f.id))
        },
        destroy:function(){
            this.parent();
            b.clear(this.id+"_text");
            b.clear(this.id+"_open")
        }
    })
})(tinymce);
(function(d){
    var c=d.DOM,b=d.dom.Event,e=d.each,a=d.util.Dispatcher;
    d.create("tinymce.ui.NativeListBox:tinymce.ui.ListBox",{
        NativeListBox:function(g,f){
            this.parent(g,f);
            this.classPrefix="mceNativeListBox"
        },
        setDisabled:function(f){
            c.get(this.id).disabled=f;
            this.setAriaProperty("disabled",f)
        },
        isDisabled:function(){
            return c.get(this.id).disabled
        },
        select:function(h){
            var g=this,j,i;
            if(h==undefined){
                return g.selectByIndex(-1)
            }
            if(h&&h.call){
                i=h
            }else{
                i=function(f){
                    return f==h
                }
            }
            if(h!=g.selectedValue){
                e(g.items,function(k,f){
                    if(i(k.value)){
                        j=1;
                        g.selectByIndex(f);
                        return false
                    }
                });
                if(!j){
                    g.selectByIndex(-1)
                }
            }
        },
        selectByIndex:function(f){
            c.get(this.id).selectedIndex=f+1;
            this.selectedValue=this.items[f]?this.items[f].value:null
        },
        add:function(j,g,f){
            var i,h=this;
            f=f||{};
    
            f.value=g;
            if(h.isRendered()){
                c.add(c.get(this.id),"option",f,j)
            }
            i={
                title:j,
                value:g,
                attribs:f
            };
    
            h.items.push(i);
            h.onAdd.dispatch(h,i)
        },
        getLength:function(){
            return this.items.length
        },
        renderHTML:function(){
            var g,f=this;
            g=c.createHTML("option",{
                value:""
            },"-- "+f.settings.title+" --");
            e(f.items,function(h){
                g+=c.createHTML("option",{
                    value:h.value
                },h.title)
            });
            g=c.createHTML("select",{
                id:f.id,
                "class":"mceNativeListBox",
                "aria-labelledby":f.id+"_aria"
            },g);
            g+=c.createHTML("span",{
                id:f.id+"_aria",
                style:"display: none"
            },f.settings.title);
            return g
        },
        postRender:function(){
            var g=this,h,i=true;
            g.rendered=true;
            function f(k){
                var j=g.items[k.target.selectedIndex-1];
                if(j&&(j=j.value)){
                    g.onChange.dispatch(g,j);
                    if(g.settings.onselect){
                        g.settings.onselect(j)
                    }
                }
            }
            b.add(g.id,"change",f);
            b.add(g.id,"keydown",function(k){
                var j;
                b.remove(g.id,"change",h);
                i=false;
                j=b.add(g.id,"blur",function(){
                    if(i){
                        return
                    }
                    i=true;
                    b.add(g.id,"change",f);
                    b.remove(g.id,"blur",j)
                });
                if(k.keyCode==13||k.keyCode==32){
                    f(k);
                    return b.cancel(k)
                }
            });
            g.onPostRender.dispatch(g,c.get(g.id))
        }
    })
})(tinymce);
(function(c){
    var b=c.DOM,a=c.dom.Event,d=c.each;
    c.create("tinymce.ui.MenuButton:tinymce.ui.Button",{
        MenuButton:function(g,f,e){
            this.parent(g,f,e);
            this.onRenderMenu=new c.util.Dispatcher(this);
            f.menu_container=f.menu_container||b.doc.body
        },
        showMenu:function(){
            var g=this,j,i,h=b.get(g.id),f;
            if(g.isDisabled()){
                return
            }
            if(!g.isMenuRendered){
                g.renderMenu();
                g.isMenuRendered=true
            }
            if(g.isMenuVisible){
                return g.hideMenu()
            }
            j=b.getPos(g.settings.menu_container);
            i=b.getPos(h);
            f=g.menu;
            f.settings.offset_x=i.x;
            f.settings.offset_y=i.y;
            f.settings.vp_offset_x=i.x;
            f.settings.vp_offset_y=i.y;
            f.settings.keyboard_focus=g._focused;
            f.showMenu(0,h.clientHeight);
            a.add(b.doc,"mousedown",g.hideMenu,g);
            g.setState("Selected",1);
            g.isMenuVisible=1
        },
        renderMenu:function(){
            var f=this,e;
            e=f.settings.control_manager.createDropMenu(f.id+"_menu",{
                menu_line:1,
                "class":this.classPrefix+"Menu",
                icons:f.settings.icons
            });
            e.onHideMenu.add(function(){
                f.hideMenu();
                f.focus()
            });
            f.onRenderMenu.dispatch(f,e);
            f.menu=e
        },
        hideMenu:function(g){
            var f=this;
            if(g&&g.type=="mousedown"&&b.getParent(g.target,function(h){
                return h.id===f.id||h.id===f.id+"_open"
            })){
                return
            }
            if(!g||!b.getParent(g.target,".mceMenu")){
                f.setState("Selected",0);
                a.remove(b.doc,"mousedown",f.hideMenu,f);
                if(f.menu){
                    f.menu.hideMenu()
                }
            }
            f.isMenuVisible=0
        },
        postRender:function(){
            var e=this,f=e.settings;
            a.add(e.id,"click",function(){
                if(!e.isDisabled()){
                    if(f.onclick){
                        f.onclick(e.value)
                    }
                    e.showMenu()
                }
            })
        }
    })
})(tinymce);
(function(c){
    var b=c.DOM,a=c.dom.Event,d=c.each;
    c.create("tinymce.ui.SplitButton:tinymce.ui.MenuButton",{
        SplitButton:function(g,f,e){
            this.parent(g,f,e);
            this.classPrefix="mceSplitButton"
        },
        renderHTML:function(){
            var i,f=this,g=f.settings,e;
            i="<tbody><tr>";
            if(g.image){
                e=b.createHTML("img ",{
                    src:g.image,
                    role:"presentation",
                    "class":"mceAction "+g["class"]
                })
            }else{
                e=b.createHTML("span",{
                    "class":"mceAction "+g["class"]
                },"")
            }
            e+=b.createHTML("span",{
                "class":"mceVoiceLabel mceIconOnly",
                id:f.id+"_voice",
                style:"display:none;"
            },g.title);
            i+="<td >"+b.createHTML("a",{
                role:"button",
                id:f.id+"_action",
                tabindex:"-1",
                href:"javascript:;",
                "class":"mceAction "+g["class"],
                onclick:"return false;",
                onmousedown:"return false;",
                title:g.title
            },e)+"</td>";
            e=b.createHTML("span",{
                "class":"mceOpen "+g["class"]
            },'<span style="display:none;" class="mceIconOnly" aria-hidden="true">\u25BC</span>');
            i+="<td >"+b.createHTML("a",{
                role:"button",
                id:f.id+"_open",
                tabindex:"-1",
                href:"javascript:;",
                "class":"mceOpen "+g["class"],
                onclick:"return false;",
                onmousedown:"return false;",
                title:g.title
            },e)+"</td>";
            i+="</tr></tbody>";
            i=b.createHTML("table",{
                id:f.id,
                role:"presentation",
                tabindex:"0",
                "class":"mceSplitButton mceSplitButtonEnabled "+g["class"],
                cellpadding:"0",
                cellspacing:"0",
                title:g.title
            },i);
            return b.createHTML("span",{
                role:"button",
                "aria-labelledby":f.id+"_voice",
                "aria-haspopup":"true"
            },i)
        },
        postRender:function(){
            var e=this,g=e.settings,f;
            if(g.onclick){
                f=function(h){
                    if(!e.isDisabled()){
                        g.onclick(e.value);
                        a.cancel(h)
                    }
                };
                
                a.add(e.id+"_action","click",f);
                a.add(e.id,["click","keydown"],function(h){
                    var k=32,m=14,i=13,j=38,l=40;
                    if((h.keyCode===32||h.keyCode===13||h.keyCode===14)&&!h.altKey&&!h.ctrlKey&&!h.metaKey){
                        f();
                        a.cancel(h)
                    }else{
                        if(h.type==="click"||h.keyCode===l){
                            e.showMenu();
                            a.cancel(h)
                        }
                    }
                })
            }
            a.add(e.id+"_open","click",function(h){
                e.showMenu();
                a.cancel(h)
            });
            a.add([e.id,e.id+"_open"],"focus",function(){
                e._focused=1
            });
            a.add([e.id,e.id+"_open"],"blur",function(){
                e._focused=0
            });
            if(c.isIE6||!b.boxModel){
                a.add(e.id,"mouseover",function(){
                    if(!b.hasClass(e.id,"mceSplitButtonDisabled")){
                        b.addClass(e.id,"mceSplitButtonHover")
                    }
                });
                a.add(e.id,"mouseout",function(){
                    if(!b.hasClass(e.id,"mceSplitButtonDisabled")){
                        b.removeClass(e.id,"mceSplitButtonHover")
                    }
                })
            }
        },
        destroy:function(){
            this.parent();
            a.clear(this.id+"_action");
            a.clear(this.id+"_open");
            a.clear(this.id)
        }
    })
})(tinymce);
(function(d){
    var c=d.DOM,a=d.dom.Event,b=d.is,e=d.each;
    d.create("tinymce.ui.ColorSplitButton:tinymce.ui.SplitButton",{
        ColorSplitButton:function(i,h,f){
            var g=this;
            g.parent(i,h,f);
            g.settings=h=d.extend({
                colors:"000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,008000,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF",
                grid_width:8,
                default_color:"#888888"
            },g.settings);
            g.onShowMenu=new d.util.Dispatcher(g);
            g.onHideMenu=new d.util.Dispatcher(g);
            g.value=h.default_color
        },
        showMenu:function(){
            var f=this,g,j,i,h;
            if(f.isDisabled()){
                return
            }
            if(!f.isMenuRendered){
                f.renderMenu();
                f.isMenuRendered=true
            }
            if(f.isMenuVisible){
                return f.hideMenu()
            }
            i=c.get(f.id);
            c.show(f.id+"_menu");
            c.addClass(i,"mceSplitButtonSelected");
            h=c.getPos(i);
            c.setStyles(f.id+"_menu",{
                left:h.x,
                top:h.y+i.clientHeight,
                zIndex:200000
            });
            i=0;
            a.add(c.doc,"mousedown",f.hideMenu,f);
            f.onShowMenu.dispatch(f);
            if(f._focused){
                f._keyHandler=a.add(f.id+"_menu","keydown",function(k){
                    if(k.keyCode==27){
                        f.hideMenu()
                    }
                });
                c.select("a",f.id+"_menu")[0].focus()
            }
            f.isMenuVisible=1
        },
        hideMenu:function(g){
            var f=this;
            if(f.isMenuVisible){
                if(g&&g.type=="mousedown"&&c.getParent(g.target,function(h){
                    return h.id===f.id+"_open"
                })){
                    return
                }
                if(!g||!c.getParent(g.target,".mceSplitButtonMenu")){
                    c.removeClass(f.id,"mceSplitButtonSelected");
                    a.remove(c.doc,"mousedown",f.hideMenu,f);
                    a.remove(f.id+"_menu","keydown",f._keyHandler);
                    c.hide(f.id+"_menu")
                }
                f.isMenuVisible=0
            }
        },
        renderMenu:function(){
            var p=this,h,k=0,q=p.settings,g,j,l,o,f;
            o=c.add(q.menu_container,"div",{
                role:"listbox",
                id:p.id+"_menu",
                "class":q.menu_class+" "+q["class"],
                style:"position:absolute;left:0;top:-1000px;"
            });
            h=c.add(o,"div",{
                "class":q["class"]+" mceSplitButtonMenu"
            });
            c.add(h,"span",{
                "class":"mceMenuLine"
            });
            g=c.add(h,"table",{
                role:"presentation",
                "class":"mceColorSplitMenu"
            });
            j=c.add(g,"tbody");
            k=0;
            e(b(q.colors,"array")?q.colors:q.colors.split(","),function(i){
                i=i.replace(/^#/,"");
                if(!k--){
                    l=c.add(j,"tr");
                    k=q.grid_width-1
                }
                g=c.add(l,"td");
                g=c.add(g,"a",{
                    role:"option",
                    href:"javascript:;",
                    style:{
                        backgroundColor:"#"+i
                    },
                    title:p.editor.getLang("colors."+i,i),
                    "data-mce-color":"#"+i
                });
                if(p.editor.forcedHighContrastMode){
                    g=c.add(g,"canvas",{
                        width:16,
                        height:16,
                        "aria-hidden":"true"
                    });
                    if(g.getContext&&(f=g.getContext("2d"))){
                        f.fillStyle="#"+i;
                        f.fillRect(0,0,16,16)
                    }else{
                        c.remove(g)
                    }
                }
            });
            if(q.more_colors_func){
                g=c.add(j,"tr");
                g=c.add(g,"td",{
                    colspan:q.grid_width,
                    "class":"mceMoreColors"
                });
                g=c.add(g,"a",{
                    role:"option",
                    id:p.id+"_more",
                    href:"javascript:;",
                    onclick:"return false;",
                    "class":"mceMoreColors"
                },q.more_colors_title);
                a.add(g,"click",function(i){
                    q.more_colors_func.call(q.more_colors_scope||this);
                    return a.cancel(i)
                })
            }
            c.addClass(h,"mceColorSplitMenu");
            new d.ui.KeyboardNavigation({
                root:p.id+"_menu",
                items:c.select("a",p.id+"_menu"),
                onCancel:function(){
                    p.hideMenu();
                    p.focus()
                }
            });
            a.add(p.id+"_menu","mousedown",function(i){
                return a.cancel(i)
            });
            a.add(p.id+"_menu","click",function(i){
                var m;
                i=c.getParent(i.target,"a",j);
                if(i&&i.nodeName.toLowerCase()=="a"&&(m=i.getAttribute("data-mce-color"))){
                    p.setColor(m)
                }
                return a.cancel(i)
            });
            return o
        },
        setColor:function(f){
            this.displayColor(f);
            this.hideMenu();
            this.settings.onselect(f)
        },
        displayColor:function(g){
            var f=this;
            c.setStyle(f.id+"_preview","backgroundColor",g);
            f.value=g
        },
        postRender:function(){
            var f=this,g=f.id;
            f.parent();
            c.add(g+"_action","div",{
                id:g+"_preview",
                "class":"mceColorPreview"
            });
            c.setStyle(f.id+"_preview","backgroundColor",f.value)
        },
        destroy:function(){
            this.parent();
            a.clear(this.id+"_menu");
            a.clear(this.id+"_more");
            c.remove(this.id+"_menu")
        }
    })
})(tinymce);
(function(b){
    var d=b.DOM,c=b.each,a=b.dom.Event;
    b.create("tinymce.ui.ToolbarGroup:tinymce.ui.Container",{
        renderHTML:function(){
            var f=this,i=[],e=f.controls,j=b.each,g=f.settings;
            i.push('<div id="'+f.id+'" role="group" aria-labelledby="'+f.id+'_voice">');
            i.push("<span role='application'>");
            i.push('<span id="'+f.id+'_voice" class="mceVoiceLabel" style="display:none;">'+d.encode(g.name)+"</span>");
            j(e,function(h){
                i.push(h.renderHTML())
            });
            i.push("</span>");
            i.push("</div>");
            return i.join("")
        },
        focus:function(){
            this.keyNav.focus()
        },
        postRender:function(){
            var f=this,e=[];
            c(f.controls,function(g){
                c(g.controls,function(h){
                    if(h.id){
                        e.push(h)
                    }
                })
            });
            f.keyNav=new b.ui.KeyboardNavigation({
                root:f.id,
                items:e,
                onCancel:function(){
                    f.editor.focus()
                },
                excludeFromTabOrder:!f.settings.tab_focus_toolbar
            })
        },
        destroy:function(){
            var e=this;
            e.parent();
            e.keyNav.destroy();
            a.clear(e.id)
        }
    })
})(tinymce);
(function(a){
    var c=a.DOM,b=a.each;
    a.create("tinymce.ui.Toolbar:tinymce.ui.Container",{
        renderHTML:function(){
            var m=this,f="",j,k,n=m.settings,e,d,g,l;
            l=m.controls;
            for(e=0;e<l.length;e++){
                k=l[e];
                d=l[e-1];
                g=l[e+1];
                if(e===0){
                    j="mceToolbarStart";
                    if(k.Button){
                        j+=" mceToolbarStartButton"
                    }else{
                        if(k.SplitButton){
                            j+=" mceToolbarStartSplitButton"
                        }else{
                            if(k.ListBox){
                                j+=" mceToolbarStartListBox"
                            }
                        }
                    }
                    f+=c.createHTML("td",{
                        "class":j
                    },c.createHTML("span",null,"<!-- IE -->"))
                }
                if(d&&k.ListBox){
                    if(d.Button||d.SplitButton){
                        f+=c.createHTML("td",{
                            "class":"mceToolbarEnd"
                        },c.createHTML("span",null,"<!-- IE -->"))
                    }
                }
                if(c.stdMode){
                    f+='<td style="position: relative">'+k.renderHTML()+"</td>"
                }else{
                    f+="<td>"+k.renderHTML()+"</td>"
                }
                if(g&&k.ListBox){
                    if(g.Button||g.SplitButton){
                        f+=c.createHTML("td",{
                            "class":"mceToolbarStart"
                        },c.createHTML("span",null,"<!-- IE -->"))
                    }
                }
            }
            j="mceToolbarEnd";
            if(k.Button){
                j+=" mceToolbarEndButton"
            }else{
                if(k.SplitButton){
                    j+=" mceToolbarEndSplitButton"
                }else{
                    if(k.ListBox){
                        j+=" mceToolbarEndListBox"
                    }
                }
            }
            f+=c.createHTML("td",{
                "class":j
            },c.createHTML("span",null,"<!-- IE -->"));
            return c.createHTML("table",{
                id:m.id,
                "class":"mceToolbar"+(n["class"]?" "+n["class"]:""),
                cellpadding:"0",
                cellspacing:"0",
                align:m.settings.align||"",
                role:"presentation",
                tabindex:"-1"
            },"<tbody><tr>"+f+"</tr></tbody>")
        }
    })
})(tinymce);
(function(b){
    var a=b.util.Dispatcher,c=b.each;
    b.create("tinymce.AddOnManager",{
        AddOnManager:function(){
            var d=this;
            d.items=[];
            d.urls={};
            
            d.lookup={};
            
            d.onAdd=new a(d)
        },
        get:function(d){
            return this.lookup[d]
        },
        requireLangPack:function(e){
            var d=b.settings;
            if(d&&d.language&&d.language_load!==false){
                b.ScriptLoader.add(this.urls[e]+"/langs/"+d.language+".js")
            }
        },
        add:function(e,d){
            this.items.push(d);
            this.lookup[e]=d;
            this.onAdd.dispatch(this,e,d);
            return d
        },
        load:function(h,e,d,g){
            var f=this;
            if(f.urls[h]){
                return
            }
            if(e.indexOf("/")!=0&&e.indexOf("://")==-1){
                e=b.baseURL+"/"+e
            }
            f.urls[h]=e.substring(0,e.lastIndexOf("/"));
            if(!f.lookup[h]){
                b.ScriptLoader.add(e,d,g)
            }
        }
    });
    b.PluginManager=new b.AddOnManager();
    b.ThemeManager=new b.AddOnManager()
}(tinymce));
(function(j){
    var g=j.each,d=j.extend,k=j.DOM,i=j.dom.Event,f=j.ThemeManager,b=j.PluginManager,e=j.explode,h=j.util.Dispatcher,a,c=0;
    j.documentBaseURL=window.location.href.replace(/[\?#].*$/,"").replace(/[\/\\][^\/]+$/,"");
    if(!/[\/\\]$/.test(j.documentBaseURL)){
        j.documentBaseURL+="/"
    }
    j.baseURL=new j.util.URI(j.documentBaseURL).toAbsolute(j.baseURL);
    j.baseURI=new j.util.URI(j.baseURL);
    j.onBeforeUnload=new h(j);
    i.add(window,"beforeunload",function(l){
        j.onBeforeUnload.dispatch(j,l)
    });
    j.onAddEditor=new h(j);
    j.onRemoveEditor=new h(j);
    j.EditorManager=d(j,{
        editors:[],
        i18n:{},
        activeEditor:null,
        init:function(q){
            var n=this,p,l=j.ScriptLoader,u,o=[],m;
            function r(x,y,t){
                var v=x[y];
                if(!v){
                    return
                }
                if(j.is(v,"string")){
                    t=v.replace(/\.\w+$/,"");
                    t=t?j.resolve(t):0;
                    v=j.resolve(v)
                }
                return v.apply(t||this,Array.prototype.slice.call(arguments,2))
            }
            q=d({
                theme:"simple",
                language:"en"
            },q);
            n.settings=q;
            i.add(document,"init",function(){
                var s,v;
                r(q,"onpageload");
                switch(q.mode){
                    case"exact":
                        s=q.elements||"";
                        if(s.length>0){
                            g(e(s),function(x){
                                if(k.get(x)){
                                    m=new j.Editor(x,q);
                                    o.push(m);
                                    m.render(1)
                                }else{
                                    g(document.forms,function(y){
                                        g(y.elements,function(z){
                                            if(z.name===x){
                                                x="mce_editor_"+c++;
                                                k.setAttrib(z,"id",x);
                                                m=new j.Editor(x,q);
                                                o.push(m);
                                                m.render(1)
                                            }
                                        })
                                    })
                                }
                            })
                        }
                        break;
                    case"textareas":case"specific_textareas":
                        function t(y,x){
                            return x.constructor===RegExp?x.test(y.className):k.hasClass(y,x)
                        }
                        g(k.select("textarea"),function(x){
                            if(q.editor_deselector&&t(x,q.editor_deselector)){
                                return
                            }
                            if(!q.editor_selector||t(x,q.editor_selector)){
                                u=k.get(x.name);
                                if(!x.id&&!u){
                                    x.id=x.name
                                }
                                if(!x.id||n.get(x.id)){
                                    x.id=k.uniqueId()
                                }
                                m=new j.Editor(x.id,q);
                                o.push(m);
                                m.render(1)
                            }
                        });
                        break
                }
                if(q.oninit){
                    s=v=0;
                    g(o,function(x){
                        v++;
                        if(!x.initialized){
                            x.onInit.add(function(){
                                s++;
                                if(s==v){
                                    r(q,"oninit")
                                }
                            })
                        }else{
                            s++
                        }
                        if(s==v){
                            r(q,"oninit")
                        }
                    })
                }
            })
        },
        get:function(l){
            if(l===a){
                return this.editors
            }
            return this.editors[l]
        },
        getInstanceById:function(l){
            return this.get(l)
        },
        add:function(m){
            var l=this,n=l.editors;
            n[m.id]=m;
            n.push(m);
            l._setActive(m);
            l.onAddEditor.dispatch(l,m);
            return m
        },
        remove:function(n){
            var m=this,l,o=m.editors;
            if(!o[n.id]){
                return null
            }
            delete o[n.id];
            for(l=0;l<o.length;l++){
                if(o[l]==n){
                    o.splice(l,1);
                    break
                }
            }
            if(m.activeEditor==n){
                m._setActive(o[0])
            }
            n.destroy();
            m.onRemoveEditor.dispatch(m,n);
            return n
        },
        execCommand:function(r,p,o){
            var q=this,n=q.get(o),l;
            switch(r){
                case"mceFocus":
                    n.focus();
                    return true;
                case"mceAddEditor":case"mceAddControl":
                    if(!q.get(o)){
                        new j.Editor(o,q.settings).render()
                    }
                    return true;
                case"mceAddFrameControl":
                    l=o.window;
                    l.tinyMCE=tinyMCE;
                    l.tinymce=j;
                    j.DOM.doc=l.document;
                    j.DOM.win=l;
                    n=new j.Editor(o.element_id,o);
                    n.render();
                    if(j.isIE){
                        function m(){
                            n.destroy();
                            l.detachEvent("onunload",m);
                            l=l.tinyMCE=l.tinymce=null
                        }
                        l.attachEvent("onunload",m)
                    }
                    o.page_window=null;
                    return true;
                case"mceRemoveEditor":case"mceRemoveControl":
                    if(n){
                        n.remove()
                    }
                    return true;
                case"mceToggleEditor":
                    if(!n){
                        q.execCommand("mceAddControl",0,o);
                        return true
                    }
                    if(n.isHidden()){
                        n.show()
                    }else{
                        n.hide()
                    }
                    return true
            }
            if(q.activeEditor){
                return q.activeEditor.execCommand(r,p,o)
            }
            return false
        },
        execInstanceCommand:function(p,o,n,m){
            var l=this.get(p);
            if(l){
                return l.execCommand(o,n,m)
            }
            return false
        },
        triggerSave:function(){
            g(this.editors,function(l){
                l.save()
            })
        },
        addI18n:function(n,q){
            var l,m=this.i18n;
            if(!j.is(n,"string")){
                g(n,function(r,p){
                    g(r,function(t,s){
                        g(t,function(v,u){
                            if(s==="common"){
                                m[p+"."+u]=v
                            }else{
                                m[p+"."+s+"."+u]=v
                            }
                        })
                    })
                })
            }else{
                g(q,function(r,p){
                    m[n+"."+p]=r
                })
            }
        },
        _setActive:function(l){
            this.selectedInstance=this.activeEditor=l
        }
    })
})(tinymce);
(function(m){
    var n=m.DOM,j=m.dom.Event,f=m.extend,k=m.util.Dispatcher,i=m.each,a=m.isGecko,b=m.isIE,e=m.isWebKit,d=m.is,h=m.ThemeManager,c=m.PluginManager,o=m.inArray,l=m.grep,g=m.explode;
    m.create("tinymce.Editor",{
        Editor:function(r,q){
            var p=this;
            p.id=p.editorId=r;
            p.execCommands={};
            
            p.queryStateCommands={};
            
            p.queryValueCommands={};
            
            p.isNotDirty=false;
            p.plugins={};
            
            i(["onPreInit","onBeforeRenderUI","onPostRender","onInit","onRemove","onActivate","onDeactivate","onClick","onEvent","onMouseUp","onMouseDown","onDblClick","onKeyDown","onKeyUp","onKeyPress","onContextMenu","onSubmit","onReset","onPaste","onPreProcess","onPostProcess","onBeforeSetContent","onBeforeGetContent","onSetContent","onGetContent","onLoadContent","onSaveContent","onNodeChange","onChange","onBeforeExecCommand","onExecCommand","onUndo","onRedo","onVisualAid","onSetProgressState"],function(s){
                p[s]=new k(p)
            });
            p.settings=q=f({
                id:r,
                language:"en",
                docs_language:"en",
                theme:"simple",
                skin:"default",
                delta_width:0,
                delta_height:0,
                popup_css:"",
                plugins:"",
                document_base_url:m.documentBaseURL,
                add_form_submit_trigger:1,
                submit_patch:1,
                add_unload_trigger:1,
                convert_urls:1,
                relative_urls:1,
                remove_script_host:1,
                table_inline_editing:0,
                object_resizing:1,
                cleanup:1,
                accessibility_focus:1,
                custom_shortcuts:1,
                custom_undo_redo_keyboard_shortcuts:1,
                custom_undo_redo_restore_selection:1,
                custom_undo_redo:1,
                doctype:m.isIE6?'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">':"<!DOCTYPE>",
                visual_table_class:"mceItemTable",
                visual:1,
                font_size_style_values:"xx-small,x-small,small,medium,large,x-large,xx-large",
                apply_source_formatting:1,
                directionality:"ltr",
                forced_root_block:"p",
                hidden_input:1,
                padd_empty_editor:1,
                render_ui:1,
                init_theme:1,
                force_p_newlines:1,
                indentation:"30px",
                keep_styles:1,
                fix_table_elements:1,
                inline_styles:1,
                convert_fonts_to_spans:true,
                indent:"simple",
                indent_before:"p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,ul,li,area,table,thead,tfoot,tbody,tr",
                indent_after:"p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,ul,li,area,table,thead,tfoot,tbody,tr",
                validate:true,
                entity_encoding:"named",
                url_converter:p.convertURL,
                url_converter_scope:p,
                ie7_compat:true
            },q);
            p.documentBaseURI=new m.util.URI(q.document_base_url||m.documentBaseURL,{
                base_uri:tinyMCE.baseURI
            });
            p.baseURI=m.baseURI;
            p.contentCSS=[];
            p.execCallback("setup",p)
        },
        render:function(r){
            var u=this,v=u.settings,x=u.id,p=m.ScriptLoader;
            if(!j.domLoaded){
                j.add(document,"init",function(){
                    u.render()
                });
                return
            }
            tinyMCE.settings=v;
            if(!u.getElement()){
                return
            }
            if(m.isIDevice){
                return
            }
            if(!/TEXTAREA|INPUT/i.test(u.getElement().nodeName)&&v.hidden_input&&n.getParent(x,"form")){
                n.insertAfter(n.create("input",{
                    type:"hidden",
                    name:x
                }),x)
            }
            if(m.WindowManager){
                u.windowManager=new m.WindowManager(u)
            }
            if(v.encoding=="xml"){
                u.onGetContent.add(function(s,t){
                    if(t.save){
                        t.content=n.encode(t.content)
                    }
                })
            }
            if(v.add_form_submit_trigger){
                u.onSubmit.addToTop(function(){
                    if(u.initialized){
                        u.save();
                        u.isNotDirty=1
                    }
                })
            }
            if(v.add_unload_trigger){
                u._beforeUnload=tinyMCE.onBeforeUnload.add(function(){
                    if(u.initialized&&!u.destroyed&&!u.isHidden()){
                        u.save({
                            format:"raw",
                            no_events:true
                        })
                    }
                })
            }
            m.addUnload(u.destroy,u);
            if(v.submit_patch){
                u.onBeforeRenderUI.add(function(){
                    var s=u.getElement().form;
                    if(!s){
                        return
                    }
                    if(s._mceOldSubmit){
                        return
                    }
                    if(!s.submit.nodeType&&!s.submit.length){
                        u.formElement=s;
                        s._mceOldSubmit=s.submit;
                        s.submit=function(){
                            m.triggerSave();
                            u.isNotDirty=1;
                            return u.formElement._mceOldSubmit(u.formElement)
                        }
                    }
                    s=null
                })
            }
            function q(){
                if(v.language&&v.language_load!==false){
                    p.add(m.baseURL+"/langs/"+v.language+".js")
                }
                if(v.theme&&v.theme.charAt(0)!="-"&&!h.urls[v.theme]){
                    h.load(v.theme,"themes/"+v.theme+"/editor_template"+m.suffix+".js")
                }
                i(g(v.plugins),function(s){
                    if(s&&s.charAt(0)!="-"&&!c.urls[s]){
                        if(s=="safari"){
                            return
                        }
                        c.load(s,"plugins/"+s+"/editor_plugin"+m.suffix+".js")
                    }
                });
                p.loadQueue(function(){
                    if(!u.removed){
                        u.init()
                    }
                })
            }
            q()
        },
        init:function(){
            var r,F=this,G=F.settings,C,z,B=F.getElement(),q,p,D,x,A,E,y;
            m.add(F);
            G.aria_label=G.aria_label||n.getAttrib(B,"aria-label",F.getLang("aria.rich_text_area"));
            if(G.theme){
                G.theme=G.theme.replace(/-/,"");
                q=h.get(G.theme);
                F.theme=new q();
                if(F.theme.init&&G.init_theme){
                    F.theme.init(F,h.urls[G.theme]||m.documentBaseURL.replace(/\/$/,""))
                }
            }
            i(g(G.plugins.replace(/\-/g,"")),function(H){
                var I=c.get(H),t=c.urls[H]||m.documentBaseURL.replace(/\/$/,""),s;
                if(I){
                    s=new I(F,t);
                    F.plugins[H]=s;
                    if(s.init){
                        s.init(F,t)
                    }
                }
            });
            if(G.popup_css!==false){
                if(G.popup_css){
                    G.popup_css=F.documentBaseURI.toAbsolute(G.popup_css)
                }else{
                    G.popup_css=F.baseURI.toAbsolute("themes/"+G.theme+"/skins/"+G.skin+"/dialog.css")
                }
            }
            if(G.popup_css_add){
                G.popup_css+=","+F.documentBaseURI.toAbsolute(G.popup_css_add)
            }
            F.controlManager=new m.ControlManager(F);
            if(G.custom_undo_redo){
                F.onBeforeExecCommand.add(function(t,H,u,I,s){
                    if(H!="Undo"&&H!="Redo"&&H!="mceRepaint"&&(!s||!s.skip_undo)){
                        F.undoManager.beforeChange()
                    }
                });
                F.onExecCommand.add(function(t,H,u,I,s){
                    if(H!="Undo"&&H!="Redo"&&H!="mceRepaint"&&(!s||!s.skip_undo)){
                        F.undoManager.add()
                    }
                })
            }
            F.onExecCommand.add(function(s,t){
                if(!/^(FontName|FontSize)$/.test(t)){
                    F.nodeChanged()
                }
            });
            if(a){
                function v(s,t){
                    if(!t||!t.initial){
                        F.execCommand("mceRepaint")
                    }
                }
                F.onUndo.add(v);
                F.onRedo.add(v);
                F.onSetContent.add(v)
            }
            F.onBeforeRenderUI.dispatch(F,F.controlManager);
            if(G.render_ui){
                C=G.width||B.style.width||B.offsetWidth;
                z=G.height||B.style.height||B.offsetHeight;
                F.orgDisplay=B.style.display;
                E=/^[0-9\.]+(|px)$/i;
                if(E.test(""+C)){
                    C=Math.max(parseInt(C)+(q.deltaWidth||0),100)
                }
                if(E.test(""+z)){
                    z=Math.max(parseInt(z)+(q.deltaHeight||0),100)
                }
                q=F.theme.renderUI({
                    targetNode:B,
                    width:C,
                    height:z,
                    deltaWidth:G.delta_width,
                    deltaHeight:G.delta_height
                });
                F.editorContainer=q.editorContainer
            }
            if(document.domain&&location.hostname!=document.domain){
                m.relaxedDomain=document.domain
            }
            n.setStyles(q.sizeContainer||q.editorContainer,{
                width:C,
                height:z
            });
            if(G.content_css){
                m.each(g(G.content_css),function(s){
                    F.contentCSS.push(F.documentBaseURI.toAbsolute(s))
                })
            }
            z=(q.iframeHeight||z)+(typeof(z)=="number"?(q.deltaHeight||0):"");
            if(z<100){
                z=100
            }
            F.iframeHTML=G.doctype+'<html><head xmlns="http://www.w3.org/1999/xhtml">';
            if(G.document_base_url!=m.documentBaseURL){
                F.iframeHTML+='<base href="'+F.documentBaseURI.getURI()+'" />'
            }
            if(G.ie7_compat){
                F.iframeHTML+='<meta http-equiv="X-UA-Compatible" content="IE=7" />'
            }else{
                F.iframeHTML+='<meta http-equiv="X-UA-Compatible" content="IE=edge" />'
            }
            F.iframeHTML+='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            if(!a||!/Firefox\/2/.test(navigator.userAgent)){
                for(y=0;y<F.contentCSS.length;y++){
                    F.iframeHTML+='<link type="text/css" rel="stylesheet" href="'+F.contentCSS[y]+'" />'
                }
                F.contentCSS=[]
            }
            x=G.body_id||"tinymce";
            if(x.indexOf("=")!=-1){
                x=F.getParam("body_id","","hash");
                x=x[F.id]||x
            }
            A=G.body_class||"";
            if(A.indexOf("=")!=-1){
                A=F.getParam("body_class","","hash");
                A=A[F.id]||""
            }
            F.iframeHTML+='</head><body id="'+x+'" class="mceContentBody '+A+'"></body></html>';
            if(m.relaxedDomain&&(b||(m.isOpera&&parseFloat(opera.version())<11))){
                D='javascript:(function(){document.open();document.domain="'+document.domain+'";var ed = window.parent.tinyMCE.get("'+F.id+'");document.write(ed.iframeHTML);document.close();ed.setupIframe();})()'
            }
            r=n.add(q.iframeContainer,"iframe",{
                id:F.id+"_ifr",
                src:D||'javascript:""',
                frameBorder:"0",
                title:G.aria_label,
                style:{
                    width:"100%",
                    height:z
                }
            });
            F.contentAreaContainer=q.iframeContainer;
            n.get(q.editorContainer).style.display=F.orgDisplay;
            n.get(F.id).style.display="none";
            n.setAttrib(F.id,"aria-hidden",true);
            if(!m.relaxedDomain||!D){
                F.setupIframe()
            }
            B=r=q=null
        },
        setupIframe:function(){
            var r=this,x=r.settings,y=n.get(r.id),z=r.getDoc(),v,p;
            if(!b||!m.relaxedDomain){
                z.open();
                z.write(r.iframeHTML);
                z.close();
                if(m.relaxedDomain){
                    z.domain=m.relaxedDomain
                }
            }
            if(!b){
                try{
                    if(!x.readonly){
                        z.designMode="On"
                    }
                }catch(q){}
            }
            if(b){
                p=r.getBody();
                n.hide(p);
                if(!x.readonly){
                    p.contentEditable=true
                }
                n.show(p)
            }
            r.schema=new m.html.Schema(x);
            r.dom=new m.dom.DOMUtils(r.getDoc(),{
                keep_values:true,
                url_converter:r.convertURL,
                url_converter_scope:r,
                hex_colors:x.force_hex_style_colors,
                class_filter:x.class_filter,
                update_styles:1,
                fix_ie_paragraphs:1,
                schema:r.schema
            });
            r.parser=new m.html.DomParser(x,r.schema);
            r.parser.addAttributeFilter("name",function(s,t){
                var B=s.length,D,A,C,E;
                while(B--){
                    E=s[B];
                    if(E.name==="a"&&E.firstChild){
                        C=E.parent;
                        D=E.lastChild;
                        do{
                            A=D.prev;
                            C.insert(D,E);
                            D=A
                        }while(D)
                    }
                }
            });
            r.parser.addAttributeFilter("src,href,style",function(s,t){
                var A=s.length,B,D=r.dom,C;
                while(A--){
                    B=s[A];
                    C=B.attr(t);
                    if(t==="style"){
                        B.attr("data-mce-style",D.serializeStyle(D.parseStyle(C),B.name))
                    }else{
                        B.attr("data-mce-"+t,r.convertURL(C,t,B.name))
                    }
                }
            });
            r.parser.addNodeFilter("script",function(s,t){
                var A=s.length;
                while(A--){
                    s[A].attr("type","mce-text/javascript")
                }
            });
            r.parser.addNodeFilter("#cdata",function(s,t){
                var A=s.length,B;
                while(A--){
                    B=s[A];
                    B.type=8;
                    B.name="#comment";
                    B.value="[CDATA["+B.value+"]]"
                }
            });
            r.parser.addNodeFilter("p,h1,h2,h3,h4,h5,h6,div",function(t,A){
                var B=t.length,C,s=r.schema.getNonEmptyElements();
                while(B--){
                    C=t[B];
                    if(C.isEmpty(s)){
                        C.empty().append(new m.html.Node("br",1)).shortEnded=true
                    }
                }
            });
            r.serializer=new m.dom.Serializer(x,r.dom,r.schema);
            r.selection=new m.dom.Selection(r.dom,r.getWin(),r.serializer);
            r.formatter=new m.Formatter(this);
            r.formatter.register({
                alignleft:[{
                    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles:{
                        textAlign:"left"
                    }
                },{
                    selector:"img,table",
                    collapsed:false,
                    styles:{
                        "float":"left"
                    }
                }],
                aligncenter:[{
                    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles:{
                        textAlign:"center"
                    }
                },{
                    selector:"img",
                    collapsed:false,
                    styles:{
                        display:"block",
                        marginLeft:"auto",
                        marginRight:"auto"
                    }
                },{
                    selector:"table",
                    collapsed:false,
                    styles:{
                        marginLeft:"auto",
                        marginRight:"auto"
                    }
                }],
                alignright:[{
                    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles:{
                        textAlign:"right"
                    }
                },{
                    selector:"img,table",
                    collapsed:false,
                    styles:{
                        "float":"right"
                    }
                }],
                alignfull:[{
                    selector:"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles:{
                        textAlign:"justify"
                    }
                }],
                bold:[{
                    inline:"strong",
                    remove:"all"
                },{
                    inline:"span",
                    styles:{
                        fontWeight:"bold"
                    }
                },{
                    inline:"b",
                    remove:"all"
                }],
                italic:[{
                    inline:"em",
                    remove:"all"
                },{
                    inline:"span",
                    styles:{
                        fontStyle:"italic"
                    }
                },{
                    inline:"i",
                    remove:"all"
                }],
                underline:[{
                    inline:"span",
                    styles:{
                        textDecoration:"underline"
                    },
                    exact:true
                },{
                    inline:"u",
                    remove:"all"
                }],
                strikethrough:[{
                    inline:"span",
                    styles:{
                        textDecoration:"line-through"
                    },
                    exact:true
                },{
                    inline:"strike",
                    remove:"all"
                }],
                forecolor:{
                    inline:"span",
                    styles:{
                        color:"%value"
                    },
                    wrap_links:false
                },
                hilitecolor:{
                    inline:"span",
                    styles:{
                        backgroundColor:"%value"
                    },
                    wrap_links:false
                },
                fontname:{
                    inline:"span",
                    styles:{
                        fontFamily:"%value"
                    }
                },
                fontsize:{
                    inline:"span",
                    styles:{
                        fontSize:"%value"
                    }
                },
                fontsize_class:{
                    inline:"span",
                    attributes:{
                        "class":"%value"
                    }
                },
                blockquote:{
                    block:"blockquote",
                    wrapper:1,
                    remove:"all"
                },
                subscript:{
                    inline:"sub"
                },
                superscript:{
                    inline:"sup"
                },
                removeformat:[{
                    selector:"b,strong,em,i,font,u,strike",
                    remove:"all",
                    split:true,
                    expand:false,
                    block_expand:true,
                    deep:true
                },{
                    selector:"span",
                    attributes:["style","class"],
                    remove:"empty",
                    split:true,
                    expand:false,
                    deep:true
                },{
                    selector:"*",
                    attributes:["style","class"],
                    split:false,
                    expand:false,
                    deep:true
                }]
            });
            i("p h1 h2 h3 h4 h5 h6 div address pre div code dt dd samp".split(/\s/),function(s){
                r.formatter.register(s,{
                    block:s,
                    remove:"all"
                })
            });
            r.formatter.register(r.settings.formats);
            r.undoManager=new m.UndoManager(r);
            r.undoManager.onAdd.add(function(t,s){
                if(t.hasUndo()){
                    return r.onChange.dispatch(r,s,t)
                }
            });
            r.undoManager.onUndo.add(function(t,s){
                return r.onUndo.dispatch(r,s,t)
            });
            r.undoManager.onRedo.add(function(t,s){
                return r.onRedo.dispatch(r,s,t)
            });
            r.forceBlocks=new m.ForceBlocks(r,{
                forced_root_block:x.forced_root_block
            });
            r.editorCommands=new m.EditorCommands(r);
            r.serializer.onPreProcess.add(function(s,t){
                return r.onPreProcess.dispatch(r,t,s)
            });
            r.serializer.onPostProcess.add(function(s,t){
                return r.onPostProcess.dispatch(r,t,s)
            });
            r.onPreInit.dispatch(r);
            if(!x.gecko_spellcheck){
                r.getBody().spellcheck=0
            }
            if(!x.readonly){
                r._addEvents()
            }
            r.controlManager.onPostRender.dispatch(r,r.controlManager);
            r.onPostRender.dispatch(r);
            if(x.directionality){
                r.getBody().dir=x.directionality
            }
            if(x.nowrap){
                r.getBody().style.whiteSpace="nowrap"
            }
            if(x.handle_node_change_callback){
                r.onNodeChange.add(function(t,s,A){
                    r.execCallback("handle_node_change_callback",r.id,A,-1,-1,true,r.selection.isCollapsed())
                })
            }
            if(x.save_callback){
                r.onSaveContent.add(function(s,A){
                    var t=r.execCallback("save_callback",r.id,A.content,r.getBody());
                    if(t){
                        A.content=t
                    }
                })
            }
            if(x.onchange_callback){
                r.onChange.add(function(t,s){
                    r.execCallback("onchange_callback",r,s)
                })
            }
            if(x.protect){
                r.onBeforeSetContent.add(function(s,t){
                    if(x.protect){
                        i(x.protect,function(A){
                            t.content=t.content.replace(A,function(B){
                                return"<!--mce:protected "+escape(B)+"-->"
                            })
                        })
                    }
                })
            }
            if(x.convert_newlines_to_brs){
                r.onBeforeSetContent.add(function(s,t){
                    if(t.initial){
                        t.content=t.content.replace(/\r?\n/g,"<br />")
                    }
                })
            }
            if(x.preformatted){
                r.onPostProcess.add(function(s,t){
                    t.content=t.content.replace(/^\s*<pre.*?>/,"");
                    t.content=t.content.replace(/<\/pre>\s*$/,"");
                    if(t.set){
                        t.content='<pre class="mceItemHidden">'+t.content+"</pre>"
                    }
                })
            }
            if(x.verify_css_classes){
                r.serializer.attribValueFilter=function(C,A){
                    var B,t;
                    if(C=="class"){
                        if(!r.classesRE){
                            t=r.dom.getClasses();
                            if(t.length>0){
                                B="";
                                i(t,function(s){
                                    B+=(B?"|":"")+s["class"]
                                });
                                r.classesRE=new RegExp("("+B+")","gi")
                            }
                        }
                        return !r.classesRE||/(\bmceItem\w+\b|\bmceTemp\w+\b)/g.test(A)||r.classesRE.test(A)?A:""
                    }
                    return A
                }
            }
            if(x.cleanup_callback){
                r.onBeforeSetContent.add(function(s,t){
                    t.content=r.execCallback("cleanup_callback","insert_to_editor",t.content,t)
                });
                r.onPreProcess.add(function(s,t){
                    if(t.set){
                        r.execCallback("cleanup_callback","insert_to_editor_dom",t.node,t)
                    }
                    if(t.get){
                        r.execCallback("cleanup_callback","get_from_editor_dom",t.node,t)
                    }
                });
                r.onPostProcess.add(function(s,t){
                    if(t.set){
                        t.content=r.execCallback("cleanup_callback","insert_to_editor",t.content,t)
                    }
                    if(t.get){
                        t.content=r.execCallback("cleanup_callback","get_from_editor",t.content,t)
                    }
                })
            }
            if(x.save_callback){
                r.onGetContent.add(function(s,t){
                    if(t.save){
                        t.content=r.execCallback("save_callback",r.id,t.content,r.getBody())
                    }
                })
            }
            if(x.handle_event_callback){
                r.onEvent.add(function(s,t,A){
                    if(r.execCallback("handle_event_callback",t,s,A)===false){
                        j.cancel(t)
                    }
                })
            }
            r.onSetContent.add(function(){
                r.addVisual(r.getBody())
            });
            if(x.padd_empty_editor){
                r.onPostProcess.add(function(s,t){
                    t.content=t.content.replace(/^(<p[^>]*>(&nbsp;|&#160;|\s|\u00a0|)<\/p>[\r\n]*|<br \/>[\r\n]*)$/,"")
                })
            }
            if(a){
                function u(s,t){
                    i(s.dom.select("a"),function(B){
                        var A=B.parentNode;
                        if(s.dom.isBlock(A)&&A.lastChild===B){
                            s.dom.add(A,"br",{
                                "data-mce-bogus":1
                            })
                        }
                    })
                }
                r.onExecCommand.add(function(s,t){
                    if(t==="CreateLink"){
                        u(s)
                    }
                });
                r.onSetContent.add(r.selection.onSetContent.add(u));
                if(!x.readonly){
                    try{
                        z.designMode="Off";
                        z.designMode="On"
                    }catch(q){}
                }
            }
            setTimeout(function(){
                if(r.removed){
                    return
                }
                r.load({
                    initial:true,
                    format:"html"
                });
                r.startContent=r.getContent({
                    format:"raw"
                });
                r.undoManager.add();
                r.initialized=true;
                r.onInit.dispatch(r);
                r.execCallback("setupcontent_callback",r.id,r.getBody(),r.getDoc());
                r.execCallback("init_instance_callback",r);
                r.focus(true);
                r.nodeChanged({
                    initial:1
                });
                i(r.contentCSS,function(s){
                    r.dom.loadCSS(s)
                });
                if(x.auto_focus){
                    setTimeout(function(){
                        var s=m.get(x.auto_focus);
                        s.selection.select(s.getBody(),1);
                        s.selection.collapse(1);
                        s.getWin().focus()
                    },100)
                }
            },1);
            y=null
        },
        focus:function(s){
            var x,q=this,v=q.settings.content_editable,r,p,u=q.getDoc();
            if(!s){
                r=q.selection.getRng();
                if(r.item){
                    p=r.item(0)
                }
                if(!v){
                    q.getWin().focus()
                }
                if(p&&p.ownerDocument==u){
                    r=u.body.createControlRange();
                    r.addElement(p);
                    r.select()
                }
            }
            if(m.activeEditor!=q){
                if((x=m.activeEditor)!=null){
                    x.onDeactivate.dispatch(x,q)
                }
                q.onActivate.dispatch(q,x)
            }
            m._setActive(q)
        },
        execCallback:function(u){
            var p=this,r=p.settings[u],q;
            if(!r){
                return
            }
            if(p.callbackLookup&&(q=p.callbackLookup[u])){
                r=q.func;
                q=q.scope
            }
            if(d(r,"string")){
                q=r.replace(/\.\w+$/,"");
                q=q?m.resolve(q):0;
                r=m.resolve(r);
                p.callbackLookup=p.callbackLookup||{};
        
                p.callbackLookup[u]={
                    func:r,
                    scope:q
                }
            }
            return r.apply(q||p,Array.prototype.slice.call(arguments,1))
        },
        translate:function(p){
            var r=this.settings.language||"en",q=m.i18n;
            if(!p){
                return""
            }
            return q[r+"."+p]||p.replace(/{\#([^}]+)\}/g,function(t,s){
                return q[r+"."+s]||"{#"+s+"}"
            })
        },
        getLang:function(q,p){
            return m.i18n[(this.settings.language||"en")+"."+q]||(d(p)?p:"{#"+q+"}")
        },
        getParam:function(u,r,p){
            var s=m.trim,q=d(this.settings[u])?this.settings[u]:r,t;
            if(p==="hash"){
                t={};
        
                if(d(q,"string")){
                    i(q.indexOf("=")>0?q.split(/[;,](?![^=;,]*(?:[;,]|$))/):q.split(","),function(x){
                        x=x.split("=");
                        if(x.length>1){
                            t[s(x[0])]=s(x[1])
                        }else{
                            t[s(x[0])]=s(x)
                        }
                    })
                }else{
                    t=q
                }
                return t
            }
            return q
        },
        nodeChanged:function(r){
            var p=this,q=p.selection,u=q.getStart()||p.getBody();
            if(p.initialized){
                r=r||{};
        
                u=b&&u.ownerDocument!=p.getDoc()?p.getBody():u;
                r.parents=[];
                p.dom.getParent(u,function(s){
                    if(s.nodeName=="BODY"){
                        return true
                    }
                    r.parents.push(s)
                });
                p.onNodeChange.dispatch(p,r?r.controlManager||p.controlManager:p.controlManager,u,q.isCollapsed(),r)
            }
        },
        addButton:function(r,q){
            var p=this;
            p.buttons=p.buttons||{};
    
            p.buttons[r]=q
        },
        addCommand:function(p,r,q){
            this.execCommands[p]={
                func:r,
                scope:q||this
            }
        },
        addQueryStateHandler:function(p,r,q){
            this.queryStateCommands[p]={
                func:r,
                scope:q||this
            }
        },
        addQueryValueHandler:function(p,r,q){
            this.queryValueCommands[p]={
                func:r,
                scope:q||this
            }
        },
        addShortcut:function(r,u,p,s){
            var q=this,v;
            if(!q.settings.custom_shortcuts){
                return false
            }
            q.shortcuts=q.shortcuts||{};
    
            if(d(p,"string")){
                v=p;
                p=function(){
                    q.execCommand(v,false,null)
                }
            }
            if(d(p,"object")){
                v=p;
                p=function(){
                    q.execCommand(v[0],v[1],v[2])
                }
            }
            i(g(r),function(t){
                var x={
                    func:p,
                    scope:s||this,
                    desc:u,
                    alt:false,
                    ctrl:false,
                    shift:false
                };
    
                i(g(t,"+"),function(y){
                    switch(y){
                        case"alt":case"ctrl":case"shift":
                            x[y]=true;
                            break;
                        default:
                            x.charCode=y.charCodeAt(0);
                            x.keyCode=y.toUpperCase().charCodeAt(0)
                    }
                });
                q.shortcuts[(x.ctrl?"ctrl":"")+","+(x.alt?"alt":"")+","+(x.shift?"shift":"")+","+x.keyCode]=x
            });
            return true
        },
        execCommand:function(x,v,z,p){
            var r=this,u=0,y,q;
            if(!/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint|SelectAll)$/.test(x)&&(!p||!p.skip_focus)){
                r.focus()
            }
            y={};
    
            r.onBeforeExecCommand.dispatch(r,x,v,z,y);
            if(y.terminate){
                return false
            }
            if(r.execCallback("execcommand_callback",r.id,r.selection.getNode(),x,v,z)){
                r.onExecCommand.dispatch(r,x,v,z,p);
                return true
            }
            if(y=r.execCommands[x]){
                q=y.func.call(y.scope,v,z);
                if(q!==true){
                    r.onExecCommand.dispatch(r,x,v,z,p);
                    return q
                }
            }
            i(r.plugins,function(s){
                if(s.execCommand&&s.execCommand(x,v,z)){
                    r.onExecCommand.dispatch(r,x,v,z,p);
                    u=1;
                    return false
                }
            });
            if(u){
                return true
            }
            if(r.theme&&r.theme.execCommand&&r.theme.execCommand(x,v,z)){
                r.onExecCommand.dispatch(r,x,v,z,p);
                return true
            }
            if(r.editorCommands.execCommand(x,v,z)){
                r.onExecCommand.dispatch(r,x,v,z,p);
                return true
            }
            r.getDoc().execCommand(x,v,z);
            r.onExecCommand.dispatch(r,x,v,z,p)
        },
        queryCommandState:function(u){
            var q=this,v,r;
            if(q._isHidden()){
                return
            }
            if(v=q.queryStateCommands[u]){
                r=v.func.call(v.scope);
                if(r!==true){
                    return r
                }
            }
            v=q.editorCommands.queryCommandState(u);
            if(v!==-1){
                return v
            }
            try{
                return this.getDoc().queryCommandState(u)
            }catch(p){}
        },
        queryCommandValue:function(v){
            var q=this,u,r;
            if(q._isHidden()){
                return
            }
            if(u=q.queryValueCommands[v]){
                r=u.func.call(u.scope);
                if(r!==true){
                    return r
                }
            }
            u=q.editorCommands.queryCommandValue(v);
            if(d(u)){
                return u
            }
            try{
                return this.getDoc().queryCommandValue(v)
            }catch(p){}
        },
        show:function(){
            var p=this;
            n.show(p.getContainer());
            n.hide(p.id);
            p.load()
        },
        hide:function(){
            var p=this,q=p.getDoc();
            if(b&&q){
                q.execCommand("SelectAll")
            }
            p.save();
            n.hide(p.getContainer());
            n.setStyle(p.id,"display",p.orgDisplay)
        },
        isHidden:function(){
            return !n.isHidden(this.id)
        },
        setProgressState:function(p,q,r){
            this.onSetProgressState.dispatch(this,p,q,r);
            return p
        },
        load:function(s){
            var p=this,r=p.getElement(),q;
            if(r){
                s=s||{};
        
                s.load=true;
                q=p.setContent(d(r.value)?r.value:r.innerHTML,s);
                s.element=r;
                if(!s.no_events){
                    p.onLoadContent.dispatch(p,s)
                }
                s.element=r=null;
                return q
            }
        },
        save:function(u){
            var p=this,s=p.getElement(),q,r;
            if(!s||!p.initialized){
                return
            }
            u=u||{};
    
            u.save=true;
            if(!u.no_events){
                p.undoManager.typing=false;
                p.undoManager.add()
            }
            u.element=s;
            q=u.content=p.getContent(u);
            if(!u.no_events){
                p.onSaveContent.dispatch(p,u)
            }
            q=u.content;
            if(!/TEXTAREA|INPUT/i.test(s.nodeName)){
                s.innerHTML=q;
                if(r=n.getParent(p.id,"form")){
                    i(r.elements,function(t){
                        if(t.name==p.id){
                            t.value=q;
                            return false
                        }
                    })
                }
            }else{
                s.value=q
            }
            u.element=s=null;
            return q
        },
        setContent:function(t,s){
            var r=this,q,p=r.getBody();
            s=s||{};
    
            s.format=s.format||"html";
            s.set=true;
            s.content=t;
            if(!s.no_events){
                r.onBeforeSetContent.dispatch(r,s)
            }
            t=s.content;
            if(!m.isIE&&(t.length===0||/^\s+$/.test(t))){
                p.innerHTML='<br data-mce-bogus="1" />';
                return
            }
            if(s.format!=="raw"){
                t=new m.html.Serializer({},r.schema).serialize(r.parser.parse(t))
            }
            s.content=m.trim(t);
            r.dom.setHTML(p,s.content);
            if(!s.no_events){
                r.onSetContent.dispatch(r,s)
            }
            return s.content
        },
        getContent:function(q){
            var p=this,r;
            q=q||{};
    
            q.format=q.format||"html";
            q.get=true;
            if(!q.no_events){
                p.onBeforeGetContent.dispatch(p,q)
            }
            if(q.format=="raw"){
                r=p.getBody().innerHTML
            }else{
                r=p.serializer.serialize(p.getBody(),q)
            }
            q.content=m.trim(r);
            if(!q.no_events){
                p.onGetContent.dispatch(p,q)
            }
            return q.content
        },
        isDirty:function(){
            var p=this;
            return m.trim(p.startContent)!=m.trim(p.getContent({
                format:"raw",
                no_events:1
            }))&&!p.isNotDirty
        },
        getContainer:function(){
            var p=this;
            if(!p.container){
                p.container=n.get(p.editorContainer||p.id+"_parent")
            }
            return p.container
        },
        getContentAreaContainer:function(){
            return this.contentAreaContainer
        },
        getElement:function(){
            return n.get(this.settings.content_element||this.id)
        },
        getWin:function(){
            var p=this,q;
            if(!p.contentWindow){
                q=n.get(p.id+"_ifr");
                if(q){
                    p.contentWindow=q.contentWindow
                }
            }
            return p.contentWindow
        },
        getDoc:function(){
            var q=this,p;
            if(!q.contentDocument){
                p=q.getWin();
                if(p){
                    q.contentDocument=p.document
                }
            }
            return q.contentDocument
        },
        getBody:function(){
            return this.bodyElement||this.getDoc().body
        },
        convertURL:function(p,x,v){
            var q=this,r=q.settings;
            if(r.urlconverter_callback){
                return q.execCallback("urlconverter_callback",p,v,true,x)
            }
            if(!r.convert_urls||(v&&v.nodeName=="LINK")||p.indexOf("file:")===0){
                return p
            }
            if(r.relative_urls){
                return q.documentBaseURI.toRelative(p)
            }
            p=q.documentBaseURI.toAbsolute(p,r.remove_script_host);
            return p
        },
        addVisual:function(r){
            var p=this,q=p.settings;
            r=r||p.getBody();
            if(!d(p.hasVisual)){
                p.hasVisual=q.visual
            }
            i(p.dom.select("table,a",r),function(t){
                var s;
                switch(t.nodeName){
                    case"TABLE":
                        s=p.dom.getAttrib(t,"border");
                        if(!s||s=="0"){
                            if(p.hasVisual){
                                p.dom.addClass(t,q.visual_table_class)
                            }else{
                                p.dom.removeClass(t,q.visual_table_class)
                            }
                        }
                        return;
                    case"A":
                        s=p.dom.getAttrib(t,"name");
                        if(s){
                            if(p.hasVisual){
                                p.dom.addClass(t,"mceItemAnchor")
                            }else{
                                p.dom.removeClass(t,"mceItemAnchor")
                            }
                        }
                        return
                }
            });
            p.onVisualAid.dispatch(p,r,p.hasVisual)
        },
        remove:function(){
            var p=this,q=p.getContainer();
            p.removed=1;
            p.hide();
            p.execCallback("remove_instance_callback",p);
            p.onRemove.dispatch(p);
            p.onExecCommand.listeners=[];
            m.remove(p);
            n.remove(q)
        },
        destroy:function(q){
            var p=this;
            if(p.destroyed){
                return
            }
            if(!q){
                m.removeUnload(p.destroy);
                tinyMCE.onBeforeUnload.remove(p._beforeUnload);
                if(p.theme&&p.theme.destroy){
                    p.theme.destroy()
                }
                p.controlManager.destroy();
                p.selection.destroy();
                p.dom.destroy();
                if(!p.settings.content_editable){
                    j.clear(p.getWin());
                    j.clear(p.getDoc())
                }
                j.clear(p.getBody());
                j.clear(p.formElement)
            }
            if(p.formElement){
                p.formElement.submit=p.formElement._mceOldSubmit;
                p.formElement._mceOldSubmit=null
            }
            p.contentAreaContainer=p.formElement=p.container=p.settings.content_element=p.bodyElement=p.contentDocument=p.contentWindow=null;
            if(p.selection){
                p.selection=p.selection.win=p.selection.dom=p.selection.dom.doc=null
            }
            p.destroyed=1
        },
        _addEvents:function(){
            var B=this,r,C=B.settings,q=B.dom,x={
                mouseup:"onMouseUp",
                mousedown:"onMouseDown",
                click:"onClick",
                keyup:"onKeyUp",
                keydown:"onKeyDown",
                keypress:"onKeyPress",
                submit:"onSubmit",
                reset:"onReset",
                contextmenu:"onContextMenu",
                dblclick:"onDblClick",
                paste:"onPaste"
            };
    
            function p(t,D){
                var s=t.type;
                if(B.removed){
                    return
                }
                if(B.onEvent.dispatch(B,t,D)!==false){
                    B[x[t.fakeType||t.type]].dispatch(B,t,D)
                }
            }
            i(x,function(t,s){
                switch(s){
                    case"contextmenu":
                        q.bind(B.getDoc(),s,p);
                        break;
                    case"paste":
                        q.bind(B.getBody(),s,function(D){
                            p(D)
                        });
                        break;
                    case"submit":case"reset":
                        q.bind(B.getElement().form||n.getParent(B.id,"form"),s,p);
                        break;
                    default:
                        q.bind(C.content_editable?B.getBody():B.getDoc(),s,p)
                }
            });
            q.bind(C.content_editable?B.getBody():(a?B.getDoc():B.getWin()),"focus",function(s){
                B.focus(true)
            });
            if(m.isGecko){
                q.bind(B.getDoc(),"DOMNodeInserted",function(t){
                    var s;
                    t=t.target;
                    if(t.nodeType===1&&t.nodeName==="IMG"&&(s=t.getAttribute("data-mce-src"))){
                        t.src=B.documentBaseURI.toAbsolute(s)
                    }
                })
            }
            if(a){
                function u(){
                    var E=this,G=E.getDoc(),F=E.settings;
                    if(a&&!F.readonly){
                        if(E._isHidden()){
                            try{
                                if(!F.content_editable){
                                    G.designMode="On"
                                }
                            }catch(D){}
                        }
                        try{
                            G.execCommand("styleWithCSS",0,false)
                        }catch(D){
                            if(!E._isHidden()){
                                try{
                                    G.execCommand("useCSS",0,true)
                                }catch(D){}
                            }
                        }
                        if(!F.table_inline_editing){
                            try{
                                G.execCommand("enableInlineTableEditing",false,false)
                            }catch(D){}
                        }
                        if(!F.object_resizing){
                            try{
                                G.execCommand("enableObjectResizing",false,false)
                            }catch(D){}
                        }
                    }
                }
                B.onBeforeExecCommand.add(u);
                B.onMouseDown.add(u)
            }
            if(m.isWebKit){
                B.onClick.add(function(s,t){
                    t=t.target;
                    if(t.nodeName=="IMG"||(t.nodeName=="A"&&q.hasClass(t,"mceItemAnchor"))){
                        B.selection.getSel().setBaseAndExtent(t,0,t,1);
                        B.nodeChanged()
                    }
                })
            }
            B.onMouseUp.add(B.nodeChanged);
            B.onKeyUp.add(function(s,t){
                var D=t.keyCode;
                if((D>=33&&D<=36)||(D>=37&&D<=40)||D==13||D==45||D==46||D==8||(m.isMac&&(D==91||D==93))||t.ctrlKey){
                    B.nodeChanged()
                }
            });
            B.onReset.add(function(){
                B.setContent(B.startContent,{
                    format:"raw"
                })
            });
            if(C.custom_shortcuts){
                if(C.custom_undo_redo_keyboard_shortcuts){
                    B.addShortcut("ctrl+z",B.getLang("undo_desc"),"Undo");
                    B.addShortcut("ctrl+y",B.getLang("redo_desc"),"Redo")
                }
                B.addShortcut("ctrl+b",B.getLang("bold_desc"),"Bold");
                B.addShortcut("ctrl+i",B.getLang("italic_desc"),"Italic");
                B.addShortcut("ctrl+u",B.getLang("underline_desc"),"Underline");
                for(r=1;r<=6;r++){
                    B.addShortcut("ctrl+"+r,"",["FormatBlock",false,"h"+r])
                }
                B.addShortcut("ctrl+7","",["FormatBlock",false,"<p>"]);
                B.addShortcut("ctrl+8","",["FormatBlock",false,"<div>"]);
                B.addShortcut("ctrl+9","",["FormatBlock",false,"<address>"]);
                function v(t){
                    var s=null;
                    if(!t.altKey&&!t.ctrlKey&&!t.metaKey){
                        return s
                    }
                    i(B.shortcuts,function(D){
                        if(m.isMac&&D.ctrl!=t.metaKey){
                            return
                        }else{
                            if(!m.isMac&&D.ctrl!=t.ctrlKey){
                                return
                            }
                        }
                        if(D.alt!=t.altKey){
                            return
                        }
                        if(D.shift!=t.shiftKey){
                            return
                        }
                        if(t.keyCode==D.keyCode||(t.charCode&&t.charCode==D.charCode)){
                            s=D;
                            return false
                        }
                    });
                    return s
                }
                B.onKeyUp.add(function(s,t){
                    var D=v(t);
                    if(D){
                        return j.cancel(t)
                    }
                });
                B.onKeyPress.add(function(s,t){
                    var D=v(t);
                    if(D){
                        return j.cancel(t)
                    }
                });
                B.onKeyDown.add(function(s,t){
                    var D=v(t);
                    if(D){
                        D.func.call(D.scope);
                        return j.cancel(t)
                    }
                })
            }
            if(m.isIE){
                q.bind(B.getDoc(),"controlselect",function(D){
                    var t=B.resizeInfo,s;
                    D=D.target;
                    if(D.nodeName!=="IMG"){
                        return
                    }
                    if(t){
                        q.unbind(t.node,t.ev,t.cb)
                    }
                    if(!q.hasClass(D,"mceItemNoResize")){
                        ev="resizeend";
                        s=q.bind(D,ev,function(F){
                            var E;
                            F=F.target;
                            if(E=q.getStyle(F,"width")){
                                q.setAttrib(F,"width",E.replace(/[^0-9%]+/g,""));
                                q.setStyle(F,"width","")
                            }
                            if(E=q.getStyle(F,"height")){
                                q.setAttrib(F,"height",E.replace(/[^0-9%]+/g,""));
                                q.setStyle(F,"height","")
                            }
                        })
                    }else{
                        ev="resizestart";
                        s=q.bind(D,"resizestart",j.cancel,j)
                    }
                    t=B.resizeInfo={
                        node:D,
                        ev:ev,
                        cb:s
                    }
                });
                B.onKeyDown.add(function(s,D){
                    var t;
                    switch(D.keyCode){
                        case 8:
                            t=B.getDoc().selection;
                            if(t.createRange&&t.createRange().item){
                                s.dom.remove(t.createRange().item(0));
                                return j.cancel(D)
                            }
                    }
                })
            }
            if(m.isOpera){
                B.onClick.add(function(s,t){
                    j.prevent(t)
                })
            }
            if(C.custom_undo_redo){
                function y(){
                    B.undoManager.typing=false;
                    B.undoManager.add()
                }
                q.bind(B.getDoc(),"focusout",function(s){
                    if(!B.removed&&B.undoManager.typing){
                        y()
                    }
                });
                B.dom.bind(B.dom.getRoot(),"dragend",function(s){
                    y()
                });
                B.onKeyUp.add(function(t,F){
                    var s,E,D;
                    if(b&&F.keyCode==8){
                        s=B.selection.getRng();
                        if(s.parentElement){
                            E=s.parentElement();
                            D=B.selection.getBookmark();
                            E.innerHTML=E.innerHTML;
                            B.selection.moveToBookmark(D)
                        }
                    }
                    if((F.keyCode>=33&&F.keyCode<=36)||(F.keyCode>=37&&F.keyCode<=40)||F.keyCode==13||F.keyCode==45||F.ctrlKey){
                        y()
                    }
                });
                B.onKeyDown.add(function(t,H){
                    var s,F,E,G=H.keyCode;
                    if(b&&G==46){
                        s=B.selection.getRng();
                        if(s.parentElement){
                            F=s.parentElement();
                            if(!B.undoManager.typing){
                                B.undoManager.beforeChange();
                                B.undoManager.typing=true;
                                B.undoManager.add()
                            }
                            if(H.ctrlKey){
                                s.moveEnd("word",1);
                                s.select()
                            }
                            B.selection.getSel().clear();
                            if(s.parentElement()==F){
                                E=B.selection.getBookmark();
                                try{
                                    F.innerHTML=F.innerHTML
                                }catch(D){}
                                B.selection.moveToBookmark(E)
                            }
                            H.preventDefault();
                            return
                        }
                    }
                    if((G>=33&&G<=36)||(G>=37&&G<=40)||G==13||G==45){
                        if(m.isIE&&G==13){
                            B.undoManager.beforeChange()
                        }
                        if(B.undoManager.typing){
                            y()
                        }
                        return
                    }
                    if((G<16||G>20)&&G!=224&&G!=91&&!B.undoManager.typing){
                        B.undoManager.beforeChange();
                        B.undoManager.add();
                        B.undoManager.typing=true
                    }
                });
                B.onMouseDown.add(function(){
                    if(B.undoManager.typing){
                        y()
                    }
                })
            }
            if(m.isGecko){
                function A(){
                    var s=B.dom.getAttribs(B.selection.getStart().cloneNode(false));
                    return function(){
                        var t=B.selection.getStart();
                        B.dom.removeAllAttribs(t);
                        i(s,function(D){
                            t.setAttributeNode(D.cloneNode(true))
                        })
                    }
                }
                function z(){
                    var t=B.selection;
                    return !t.isCollapsed()&&t.getStart()!=t.getEnd()
                }
                B.onKeyPress.add(function(s,D){
                    var t;
                    if((D.keyCode==8||D.keyCode==46)&&z()){
                        t=A();
                        B.getDoc().execCommand("delete",false,null);
                        t();
                        return j.cancel(D)
                    }
                });
                B.dom.bind(B.getDoc(),"cut",function(t){
                    var s;
                    if(z()){
                        s=A();
                        B.onKeyUp.addToTop(j.cancel,j);
                        setTimeout(function(){
                            s();
                            B.onKeyUp.remove(j.cancel,j)
                        },0)
                    }
                })
            }
        },
        _isHidden:function(){
            var p;
            if(!a){
                return 0
            }
            p=this.selection.getSel();
            return(!p||!p.rangeCount||p.rangeCount==0)
        }
    })
})(tinymce);
(function(c){
    var d=c.each,e,a=true,b=false;
    c.EditorCommands=function(n){
        var l=n.dom,p=n.selection,j={
            state:{},
            exec:{},
            value:{}
        },k=n.settings,o;
        function q(y,x,v){
            var u;
            y=y.toLowerCase();
            if(u=j.exec[y]){
                u(y,x,v);
                return a
            }
            return b
        }
        function m(v){
            var u;
            v=v.toLowerCase();
            if(u=j.state[v]){
                return u(v)
            }
            return -1
        }
        function h(v){
            var u;
            v=v.toLowerCase();
            if(u=j.value[v]){
                return u(v)
            }
            return b
        }
        function t(u,v){
            v=v||"exec";
            d(u,function(y,x){
                d(x.toLowerCase().split(","),function(z){
                    j[v][z]=y
                })
            })
        }
        c.extend(this,{
            execCommand:q,
            queryCommandState:m,
            queryCommandValue:h,
            addCommands:t
        });
        function f(x,v,u){
            if(v===e){
                v=b
            }
            if(u===e){
                u=null
            }
            return n.getDoc().execCommand(x,v,u)
        }
        function s(u){
            return n.formatter.match(u)
        }
        function r(u,v){
            n.formatter.toggle(u,v?{
                value:v
            }:e)
        }
        function i(u){
            o=p.getBookmark(u)
        }
        function g(){
            p.moveToBookmark(o)
        }
        t({
            "mceResetDesignMode,mceBeginUndoLevel":function(){},
            "mceEndUndoLevel,mceAddUndoLevel":function(){
                n.undoManager.add()
            },
            "Cut,Copy,Paste":function(y){
                var x=n.getDoc(),u;
                try{
                    f(y)
                }catch(v){
                    u=a
                }
                if(u||!x.queryCommandSupported(y)){
                    if(c.isGecko){
                        n.windowManager.confirm(n.getLang("clipboard_msg"),function(z){
                            if(z){
                                open("http://www.mozilla.org/editor/midasdemo/securityprefs.html","_blank")
                            }
                        })
                    }else{
                        n.windowManager.alert(n.getLang("clipboard_no_support"))
                    }
                }
            },
            unlink:function(u){
                if(p.isCollapsed()){
                    p.select(p.getNode())
                }
                f(u);
                p.collapse(b)
            },
            "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull":function(u){
                var v=u.substring(7);
                d("left,center,right,full".split(","),function(x){
                    if(v!=x){
                        n.formatter.remove("align"+x)
                    }
                });
                r("align"+v);
                q("mceRepaint")
            },
            "InsertUnorderedList,InsertOrderedList":function(x){
                var u,v;
                f(x);
                u=l.getParent(p.getNode(),"ol,ul");
                if(u){
                    v=u.parentNode;
                    if(/^(H[1-6]|P|ADDRESS|PRE)$/.test(v.nodeName)){
                        i();
                        l.split(v,u);
                        g()
                    }
                }
            },
            "Bold,Italic,Underline,Strikethrough,Superscript,Subscript":function(u){
                r(u)
            },
            "ForeColor,HiliteColor,FontName":function(x,v,u){
                r(x,u)
            },
            FontSize:function(y,x,v){
                var u,z;
                if(v>=1&&v<=7){
                    z=c.explode(k.font_size_style_values);
                    u=c.explode(k.font_size_classes);
                    if(u){
                        v=u[v-1]||v
                    }else{
                        v=z[v-1]||v
                    }
                }
                r(y,v)
            },
            RemoveFormat:function(u){
                n.formatter.remove(u)
            },
            mceBlockQuote:function(u){
                r("blockquote")
            },
            FormatBlock:function(x,v,u){
                return r(u||"p")
            },
            mceCleanup:function(){
                var u=p.getBookmark();
                n.setContent(n.getContent({
                    cleanup:a
                }),{
                    cleanup:a
                });
                p.moveToBookmark(u)
            },
            mceRemoveNode:function(y,x,v){
                var u=v||p.getNode();
                if(u!=n.getBody()){
                    i();
                    n.dom.remove(u,a);
                    g()
                }
            },
            mceSelectNodeDepth:function(y,x,v){
                var u=0;
                l.getParent(p.getNode(),function(z){
                    if(z.nodeType==1&&u++==v){
                        p.select(z);
                        return b
                    }
                },n.getBody())
            },
            mceSelectNode:function(x,v,u){
                p.select(u)
            },
            mceInsertContent:function(z,D,E){
                var C,u,x,F,y,u,A,G,B;
                function v(I,J,H){
                    var K=new c.dom.TreeWalker(H?I.nextSibling:I.previousSibling,J);
                    while((I=K.current())){
                        if((I.nodeType==3&&c.trim(I.nodeValue).length)||I.nodeName=="BR"||I.nodeName=="IMG"){
                            return I
                        }
                        if(H){
                            K.next()
                        }else{
                            K.prev()
                        }
                    }
                }
                B={
                    content:E,
                    format:"html"
                };

                p.onBeforeSetContent.dispatch(p,B);
                E=B.content;
                if(E.indexOf("{$caret}")==-1){
                    E+="{$caret}"
                }
                p.setContent('<span id="__mce">\uFEFF</span>',{
                    no_events:false
                });
                l.setOuterHTML("__mce",E.replace(/\{\$caret\}/,'<span data-mce-type="bookmark" id="__mce">\uFEFF</span>'));
                C=l.select("#__mce")[0];
                x=l.getRoot();
                if(C.previousSibling&&l.isBlock(C.previousSibling)||C.parentNode==x){
                    y=v(C,x);
                    if(y){
                        if(y.nodeName=="BR"){
                            y.parentNode.insertBefore(C,y)
                        }else{
                            l.insertAfter(C,y)
                        }
                    }
                }while(C){
                    if(C===x){
                        l.setOuterHTML(F,new c.html.Serializer({},n.schema).serialize(n.parser.parse(l.getOuterHTML(F))));
                        break
                    }
                    F=C;
                    C=C.parentNode
                }
                C=l.select("#__mce")[0];
                if(C){
                    y=v(C,x)||v(C,x,true);
                    l.remove(C);
                    if(y){
                        u=l.createRng();
                        if(y.nodeType==3){
                            u.setStart(y,y.length);
                            u.setEnd(y,y.length)
                        }else{
                            if(y.nodeName=="BR"){
                                u.setStartBefore(y);
                                u.setEndBefore(y)
                            }else{
                                u.setStartAfter(y);
                                u.setEndAfter(y)
                            }
                        }
                        p.setRng(u);
                        if(!c.isIE){
                            y=l.create("span",null,"\u00a0");
                            u.insertNode(y);
                            A=l.getRect(y);
                            G=l.getViewPort(n.getWin());
                            if((A.y>G.y+G.h||A.y<G.y)||(A.x>G.x+G.w||A.x<G.x)){
                                n.getBody().scrollLeft=A.x;
                                n.getBody().scrollTop=A.y
                            }
                            l.remove(y)
                        }
                        p.collapse(true)
                    }
                }
                p.onSetContent.dispatch(p,B);
                n.addVisual()
            },
            mceInsertRawHTML:function(x,v,u){
                p.setContent("tiny_mce_marker");
                n.setContent(n.getContent().replace(/tiny_mce_marker/g,function(){
                    return u
                }))
            },
            mceSetContent:function(x,v,u){
                n.setContent(u)
            },
            "Indent,Outdent":function(y){
                var v,u,x;
                v=k.indentation;
                u=/[a-z%]+$/i.exec(v);
                v=parseInt(v);
                if(!m("InsertUnorderedList")&&!m("InsertOrderedList")){
                    d(p.getSelectedBlocks(),function(z){
                        if(y=="outdent"){
                            x=Math.max(0,parseInt(z.style.paddingLeft||0)-v);
                            l.setStyle(z,"paddingLeft",x?x+u:"")
                        }else{
                            l.setStyle(z,"paddingLeft",(parseInt(z.style.paddingLeft||0)+v)+u)
                        }
                    })
                }else{
                    f(y)
                }
            },
            mceRepaint:function(){
                var v;
                if(c.isGecko){
                    try{
                        i(a);
                        if(p.getSel()){
                            p.getSel().selectAllChildren(n.getBody())
                        }
                        p.collapse(a);
                        g()
                    }catch(u){}
                }
            },
            mceToggleFormat:function(x,v,u){
                n.formatter.toggle(u)
            },
            InsertHorizontalRule:function(){
                n.execCommand("mceInsertContent",false,"<hr />")
            },
            mceToggleVisualAid:function(){
                n.hasVisual=!n.hasVisual;
                n.addVisual()
            },
            mceReplaceContent:function(x,v,u){
                n.execCommand("mceInsertContent",false,u.replace(/\{\$selection\}/g,p.getContent({
                    format:"text"
                })))
            },
            mceInsertLink:function(A,z,y){
                var x=l.getParent(p.getNode(),"a"),v,u;
                if(c.is(y,"string")){
                    y={
                        href:y
                    }
                }
                y.href=y.href.replace(" ","%20");
                if(!x){
                    if(c.isWebKit){
                        v=l.getParent(p.getNode(),"img");
                        if(v){
                            u=v.style.cssFloat;
                            v.style.cssFloat=null
                        }
                    }
                    f("CreateLink",b,"javascript:mctmp(0);");
                    if(u){
                        v.style.cssFloat=u
                    }
                    d(l.select("a[href='javascript:mctmp(0);']"),function(B){
                        l.setAttribs(B,y)
                    })
                }else{
                    if(y.href){
                        l.setAttribs(x,y)
                    }else{
                        n.dom.remove(x,a)
                    }
                }
            },
            selectAll:function(){
                var v=l.getRoot(),u=l.createRng();
                u.setStart(v,0);
                u.setEnd(v,v.childNodes.length);
                n.selection.setRng(u)
            }
        });
        t({
            "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull":function(u){
                return s("align"+u.substring(7))
            },
            "Bold,Italic,Underline,Strikethrough,Superscript,Subscript":function(u){
                return s(u)
            },
            mceBlockQuote:function(){
                return s("blockquote")
            },
            Outdent:function(){
                var u;
                if(k.inline_styles){
                    if((u=l.getParent(p.getStart(),l.isBlock))&&parseInt(u.style.paddingLeft)>0){
                        return a
                    }
                    if((u=l.getParent(p.getEnd(),l.isBlock))&&parseInt(u.style.paddingLeft)>0){
                        return a
                    }
                }
                return m("InsertUnorderedList")||m("InsertOrderedList")||(!k.inline_styles&&!!l.getParent(p.getNode(),"BLOCKQUOTE"))
            },
            "InsertUnorderedList,InsertOrderedList":function(u){
                return l.getParent(p.getNode(),u=="insertunorderedlist"?"UL":"OL")
            }
        },"state");
        t({
            "FontSize,FontName":function(x){
                var v=0,u;
                if(u=l.getParent(p.getNode(),"span")){
                    if(x=="fontsize"){
                        v=u.style.fontSize
                    }else{
                        v=u.style.fontFamily.replace(/, /g,",").replace(/[\'\"]/g,"").toLowerCase()
                    }
                }
                return v
            }
        },"value");
        if(k.custom_undo_redo){
            t({
                Undo:function(){
                    n.undoManager.undo()
                },
                Redo:function(){
                    n.undoManager.redo()
                }
            })
        }
    }
})(tinymce);
(function(b){
    var a=b.util.Dispatcher;
    b.UndoManager=function(e){
        var c,d=0,g=[];
        function f(){
            return b.trim(e.getContent({
                format:"raw",
                no_events:1
            }))
        }
        return c={
            typing:false,
            onAdd:new a(c),
            onUndo:new a(c),
            onRedo:new a(c),
            beforeChange:function(){
                if(g[d]){
                    g[d].beforeBookmark=e.selection.getBookmark(2,true)
                }
            },
            add:function(l){
                var h,j=e.settings,k;
                l=l||{};
            
                l.content=f();
                k=g[d];
                if(k&&k.content==l.content){
                    return null
                }
                if(j.custom_undo_redo_levels){
                    if(g.length>j.custom_undo_redo_levels){
                        for(h=0;h<g.length-1;h++){
                            g[h]=g[h+1]
                        }
                        g.length--;
                        d=g.length
                    }
                }
                l.bookmark=e.selection.getBookmark(2,true);
                if(d<g.length-1){
                    g.length=d+1
                }
                g.push(l);
                d=g.length-1;
                c.onAdd.dispatch(c,l);
                e.isNotDirty=0;
                return l
            },
            undo:function(){
                var j,h;
                if(c.typing){
                    c.add();
                    c.typing=false
                }
                if(d>0){
                    j=g[--d];
                    e.setContent(j.content,{
                        format:"raw"
                    });
                    e.selection.moveToBookmark(j.beforeBookmark);
                    c.onUndo.dispatch(c,j)
                }
                return j
            },
            redo:function(){
                var h;
                if(d<g.length-1){
                    h=g[++d];
                    e.setContent(h.content,{
                        format:"raw"
                    });
                    e.selection.moveToBookmark(h.bookmark);
                    c.onRedo.dispatch(c,h)
                }
                return h
            },
            clear:function(){
                g=[];
                d=0;
                c.typing=false
            },
            hasUndo:function(){
                return d>0||this.typing
            },
            hasRedo:function(){
                return d<g.length-1&&!this.typing
            }
        }
    }
})(tinymce);
(function(l){
    var j=l.dom.Event,c=l.isIE,a=l.isGecko,b=l.isOpera,i=l.each,h=l.extend,d=true,g=false;
    function k(o){
        var p,n,m;
        do{
            if(/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(o.nodeName)){
                if(p){
                    n=o.cloneNode(false);
                    n.appendChild(p);
                    p=n
                }else{
                    p=m=o.cloneNode(false)
                }
                p.removeAttribute("id")
            }
        }while(o=o.parentNode);
        if(p){
            return{
                wrapper:p,
                inner:m
            }
        }
    }
    function f(n,o){
        var m=o.ownerDocument.createRange();
        m.setStart(n.endContainer,n.endOffset);
        m.setEndAfter(o);
        return m.cloneContents().textContent.length==0
    }
    function e(o,q,m){
        var n,p;
        if(q.isEmpty(m)){
            n=q.getParent(m,"ul,ol");
            if(!q.getParent(n.parentNode,"ul,ol")){
                q.split(n,m);
                p=q.create("p",0,'<br data-mce-bogus="1" />');
                q.replace(p,m);
                o.select(p,1)
            }
            return g
        }
        return d
    }
    l.create("tinymce.ForceBlocks",{
        ForceBlocks:function(m){
            var n=this,o=m.settings,p;
            n.editor=m;
            n.dom=m.dom;
            p=(o.forced_root_block||"p").toLowerCase();
            o.element=p.toUpperCase();
            m.onPreInit.add(n.setup,n);
            if(o.forced_root_block){
                m.onInit.add(n.forceRoots,n);
                m.onSetContent.add(n.forceRoots,n);
                m.onBeforeGetContent.add(n.forceRoots,n);
                m.onExecCommand.add(function(q,r){
                    if(r=="mceInsertContent"){
                        n.forceRoots();
                        q.nodeChanged()
                    }
                })
            }
        },
        setup:function(){
            var n=this,m=n.editor,p=m.settings,r=m.dom,o=m.selection;
            if(p.forced_root_block){
                m.onBeforeExecCommand.add(n.forceRoots,n);
                m.onKeyUp.add(n.forceRoots,n);
                m.onPreProcess.add(n.forceRoots,n)
            }
            if(p.force_br_newlines){
                if(c){
                    m.onKeyPress.add(function(s,t){
                        var u;
                        if(t.keyCode==13&&o.getNode().nodeName!="LI"){
                            o.setContent('<br id="__" /> ',{
                                format:"raw"
                            });
                            u=r.get("__");
                            u.removeAttribute("id");
                            o.select(u);
                            o.collapse();
                            return j.cancel(t)
                        }
                    })
                }
            }
            if(p.force_p_newlines){
                if(!c){
                    m.onKeyPress.add(function(s,t){
                        if(t.keyCode==13&&!t.shiftKey&&!n.insertPara(t)){
                            j.cancel(t)
                        }
                    })
                }else{
                    l.addUnload(function(){
                        n._previousFormats=0
                    });
                    m.onKeyPress.add(function(s,t){
                        n._previousFormats=0;
                        if(t.keyCode==13&&!t.shiftKey&&s.selection.isCollapsed()&&p.keep_styles){
                            n._previousFormats=k(s.selection.getStart())
                        }
                    });
                    m.onKeyUp.add(function(t,v){
                        if(v.keyCode==13&&!v.shiftKey){
                            var u=t.selection.getStart(),s=n._previousFormats;
                            if(!u.hasChildNodes()&&s){
                                u=r.getParent(u,r.isBlock);
                                if(u&&u.nodeName!="LI"){
                                    u.innerHTML="";
                                    if(n._previousFormats){
                                        u.appendChild(s.wrapper);
                                        s.inner.innerHTML="\uFEFF"
                                    }else{
                                        u.innerHTML="\uFEFF"
                                    }
                                    o.select(u,1);
                                    o.collapse(true);
                                    t.getDoc().execCommand("Delete",false,null);
                                    n._previousFormats=0
                                }
                            }
                        }
                    })
                }
                if(a){
                    m.onKeyDown.add(function(s,t){
                        if((t.keyCode==8||t.keyCode==46)&&!t.shiftKey){
                            n.backspaceDelete(t,t.keyCode==8)
                        }
                    })
                }
            }
            if(l.isWebKit){
                function q(t){
                    var s=o.getRng(),u,y=r.create("div",null," "),x,v=r.getViewPort(t.getWin()).h;
                    s.insertNode(u=r.create("br"));
                    s.setStartAfter(u);
                    s.setEndAfter(u);
                    o.setRng(s);
                    if(o.getSel().focusNode==u.previousSibling){
                        o.select(r.insertAfter(r.doc.createTextNode("\u00a0"),u));
                        o.collapse(d)
                    }
                    r.insertAfter(y,u);
                    x=r.getPos(y).y;
                    r.remove(y);
                    if(x>v){
                        t.getWin().scrollTo(0,x)
                    }
                }
                m.onKeyPress.add(function(s,t){
                    if(t.keyCode==13&&(t.shiftKey||(p.force_br_newlines&&!r.getParent(o.getNode(),"h1,h2,h3,h4,h5,h6,ol,ul")))){
                        q(s);
                        j.cancel(t)
                    }
                })
            }
            if(c){
                if(p.element!="P"){
                    m.onKeyPress.add(function(s,t){
                        n.lastElm=o.getNode().nodeName
                    });
                    m.onKeyUp.add(function(t,u){
                        var x,v=o.getNode(),s=t.getBody();
                        if(s.childNodes.length===1&&v.nodeName=="P"){
                            v=r.rename(v,p.element);
                            o.select(v);
                            o.collapse();
                            t.nodeChanged()
                        }else{
                            if(u.keyCode==13&&!u.shiftKey&&n.lastElm!="P"){
                                x=r.getParent(v,"p");
                                if(x){
                                    r.rename(x,p.element);
                                    t.nodeChanged()
                                }
                            }
                        }
                    })
                }
            }
        },
        find:function(u,p,q){
            var o=this.editor,m=o.getDoc().createTreeWalker(u,4,null,g),r=-1;
            while(u=m.nextNode()){
                r++;
                if(p==0&&u==q){
                    return r
                }
                if(p==1&&r==q){
                    return u
                }
            }
            return -1
        },
        forceRoots:function(v,H){
            var y=this,v=y.editor,L=v.getBody(),I=v.getDoc(),O=v.selection,z=O.getSel(),A=O.getRng(),M=-2,u,F,m,o,J=-16777215;
            var K,p,N,E,B,q=L.childNodes,D,C,x;
            for(D=q.length-1;D>=0;D--){
                K=q[D];
                if(K.nodeType===1&&K.getAttribute("data-mce-type")){
                    p=null;
                    continue
                }
                if(K.nodeType===3||(!y.dom.isBlock(K)&&K.nodeType!==8&&!/^(script|mce:script|style|mce:style)$/i.test(K.nodeName))){
                    if(!p){
                        if(K.nodeType!=3||/[^\s]/g.test(K.nodeValue)){
                            if(M==-2&&A){
                                if(!c||A.setStart){
                                    if(A.startContainer.nodeType==1&&(C=A.startContainer.childNodes[A.startOffset])&&C.nodeType==1){
                                        x=C.getAttribute("id");
                                        C.setAttribute("id","__mce")
                                    }else{
                                        if(v.dom.getParent(A.startContainer,function(n){
                                            return n===L
                                        })){
                                            F=A.startOffset;
                                            m=A.endOffset;
                                            M=y.find(L,0,A.startContainer);
                                            u=y.find(L,0,A.endContainer)
                                        }
                                    }
                                }else{
                                    if(A.item){
                                        o=I.body.createTextRange();
                                        o.moveToElementText(A.item(0));
                                        A=o
                                    }
                                    o=I.body.createTextRange();
                                    o.moveToElementText(L);
                                    o.collapse(1);
                                    N=o.move("character",J)*-1;
                                    o=A.duplicate();
                                    o.collapse(1);
                                    E=o.move("character",J)*-1;
                                    o=A.duplicate();
                                    o.collapse(0);
                                    B=(o.move("character",J)*-1)-E;
                                    M=E-N;
                                    u=B
                                }
                            }
                            p=v.dom.create(v.settings.forced_root_block);
                            K.parentNode.replaceChild(p,K);
                            p.appendChild(K)
                        }
                    }else{
                        if(p.hasChildNodes()){
                            p.insertBefore(K,p.firstChild)
                        }else{
                            p.appendChild(K)
                        }
                    }
                }else{
                    p=null
                }
            }
            if(M!=-2){
                if(!c||A.setStart){
                    p=L.getElementsByTagName(v.settings.element)[0];
                    A=I.createRange();
                    if(M!=-1){
                        A.setStart(y.find(L,1,M),F)
                    }else{
                        A.setStart(p,0)
                    }
                    if(u!=-1){
                        A.setEnd(y.find(L,1,u),m)
                    }else{
                        A.setEnd(p,0)
                    }
                    if(z){
                        z.removeAllRanges();
                        z.addRange(A)
                    }
                }else{
                    try{
                        A=z.createRange();
                        A.moveToElementText(L);
                        A.collapse(1);
                        A.moveStart("character",M);
                        A.moveEnd("character",u);
                        A.select()
                    }catch(G){}
                }
            }else{
                if((!c||A.setStart)&&(C=v.dom.get("__mce"))){
                    if(x){
                        C.setAttribute("id",x)
                    }else{
                        C.removeAttribute("id")
                    }
                    A=I.createRange();
                    A.setStartBefore(C);
                    A.setEndBefore(C);
                    O.setRng(A)
                }
            }
        },
        getParentBlock:function(o){
            var m=this.dom;
            return m.getParent(o,m.isBlock)
        },
        insertPara:function(R){
            var F=this,v=F.editor,N=v.dom,S=v.getDoc(),W=v.settings,G=v.selection.getSel(),H=G.getRangeAt(0),V=S.body;
            var K,L,I,P,O,q,o,u,z,m,D,U,p,x,J,M=N.getViewPort(v.getWin()),C,E,B;
            v.undoManager.beforeChange();
            K=S.createRange();
            K.setStart(G.anchorNode,G.anchorOffset);
            K.collapse(d);
            L=S.createRange();
            L.setStart(G.focusNode,G.focusOffset);
            L.collapse(d);
            I=K.compareBoundaryPoints(K.START_TO_END,L)<0;
            P=I?G.anchorNode:G.focusNode;
            O=I?G.anchorOffset:G.focusOffset;
            q=I?G.focusNode:G.anchorNode;
            o=I?G.focusOffset:G.anchorOffset;
            if(P===q&&/^(TD|TH)$/.test(P.nodeName)){
                if(P.firstChild.nodeName=="BR"){
                    N.remove(P.firstChild)
                }
                if(P.childNodes.length==0){
                    v.dom.add(P,W.element,null,"<br />");
                    U=v.dom.add(P,W.element,null,"<br />")
                }else{
                    J=P.innerHTML;
                    P.innerHTML="";
                    v.dom.add(P,W.element,null,J);
                    U=v.dom.add(P,W.element,null,"<br />")
                }
                H=S.createRange();
                H.selectNodeContents(U);
                H.collapse(1);
                v.selection.setRng(H);
                return g
            }
            if(P==V&&q==V&&V.firstChild&&v.dom.isBlock(V.firstChild)){
                P=q=P.firstChild;
                O=o=0;
                K=S.createRange();
                K.setStart(P,0);
                L=S.createRange();
                L.setStart(q,0)
            }
            P=P.nodeName=="HTML"?S.body:P;
            P=P.nodeName=="BODY"?P.firstChild:P;
            q=q.nodeName=="HTML"?S.body:q;
            q=q.nodeName=="BODY"?q.firstChild:q;
            u=F.getParentBlock(P);
            z=F.getParentBlock(q);
            m=u?u.nodeName:W.element;
            if(J=F.dom.getParent(u,"li,pre")){
                if(J.nodeName=="LI"){
                    return e(v.selection,F.dom,J)
                }
                return d
            }
            if(u&&(u.nodeName=="CAPTION"||/absolute|relative|fixed/gi.test(N.getStyle(u,"position",1)))){
                m=W.element;
                u=null
            }
            if(z&&(z.nodeName=="CAPTION"||/absolute|relative|fixed/gi.test(N.getStyle(u,"position",1)))){
                m=W.element;
                z=null
            }
            if(/(TD|TABLE|TH|CAPTION)/.test(m)||(u&&m=="DIV"&&/left|right/gi.test(N.getStyle(u,"float",1)))){
                m=W.element;
                u=z=null
            }
            D=(u&&u.nodeName==m)?u.cloneNode(0):v.dom.create(m);
            U=(z&&z.nodeName==m)?z.cloneNode(0):v.dom.create(m);
            U.removeAttribute("id");
            if(/^(H[1-6])$/.test(m)&&f(H,u)){
                U=v.dom.create(W.element)
            }
            J=p=P;
            do{
                if(J==V||J.nodeType==9||F.dom.isBlock(J)||/(TD|TABLE|TH|CAPTION)/.test(J.nodeName)){
                    break
                }
                p=J
            }while((J=J.previousSibling?J.previousSibling:J.parentNode));
            J=x=q;
            do{
                if(J==V||J.nodeType==9||F.dom.isBlock(J)||/(TD|TABLE|TH|CAPTION)/.test(J.nodeName)){
                    break
                }
                x=J
            }while((J=J.nextSibling?J.nextSibling:J.parentNode));
            if(p.nodeName==m){
                K.setStart(p,0)
            }else{
                K.setStartBefore(p)
            }
            K.setEnd(P,O);
            D.appendChild(K.cloneContents()||S.createTextNode(""));
            try{
                L.setEndAfter(x)
            }catch(Q){}
            L.setStart(q,o);
            U.appendChild(L.cloneContents()||S.createTextNode(""));
            H=S.createRange();
            if(!p.previousSibling&&p.parentNode.nodeName==m){
                H.setStartBefore(p.parentNode)
            }else{
                if(K.startContainer.nodeName==m&&K.startOffset==0){
                    H.setStartBefore(K.startContainer)
                }else{
                    H.setStart(K.startContainer,K.startOffset)
                }
            }
            if(!x.nextSibling&&x.parentNode.nodeName==m){
                H.setEndAfter(x.parentNode)
            }else{
                H.setEnd(L.endContainer,L.endOffset)
            }
            H.deleteContents();
            if(b){
                v.getWin().scrollTo(0,M.y)
            }
            if(D.firstChild&&D.firstChild.nodeName==m){
                D.innerHTML=D.firstChild.innerHTML
            }
            if(U.firstChild&&U.firstChild.nodeName==m){
                U.innerHTML=U.firstChild.innerHTML
            }
            if(N.isEmpty(D)){
                D.innerHTML="<br />"
            }
            function T(y,s){
                var r=[],Y,X,t;
                y.innerHTML="";
                if(W.keep_styles){
                    X=s;
                    do{
                        if(/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(X.nodeName)){
                            Y=X.cloneNode(g);
                            N.setAttrib(Y,"id","");
                            r.push(Y)
                        }
                    }while(X=X.parentNode)
                }
                if(r.length>0){
                    for(t=r.length-1,Y=y;t>=0;t--){
                        Y=Y.appendChild(r[t])
                    }
                    r[0].innerHTML=b?"\u00a0":"<br />";
                    return r[0]
                }else{
                    y.innerHTML=b?"\u00a0":"<br />"
                }
            }
            if(N.isEmpty(U)){
                B=T(U,q)
            }
            if(b&&parseFloat(opera.version())<9.5){
                H.insertNode(D);
                H.insertNode(U)
            }else{
                H.insertNode(U);
                H.insertNode(D)
            }
            U.normalize();
            D.normalize();
            function A(r){
                return S.createTreeWalker(r,NodeFilter.SHOW_TEXT,null,g).nextNode()||r
            }
            H=S.createRange();
            H.selectNodeContents(a?A(B||U):B||U);
            H.collapse(1);
            G.removeAllRanges();
            G.addRange(H);
            C=v.dom.getPos(U).y;
            if(C<M.y||C+25>M.y+M.h){
                v.getWin().scrollTo(0,C<M.y?C:C-M.h+25)
            }
            v.undoManager.add();
            return g
        },
        backspaceDelete:function(u,B){
            var C=this,s=C.editor,y=s.getBody(),q=s.dom,p,v=s.selection,o=v.getRng(),x=o.startContainer,p,z,A,m;
            if(!B&&o.collapsed&&x.nodeType==1&&o.startOffset==x.childNodes.length){
                m=new l.dom.TreeWalker(x.lastChild,x);
                for(p=x.lastChild;p;p=m.prev()){
                    if(p.nodeType==3){
                        o.setStart(p,p.nodeValue.length);
                        o.collapse(true);
                        v.setRng(o);
                        return
                    }
                }
            }
            if(x&&s.dom.isBlock(x)&&!/^(TD|TH)$/.test(x.nodeName)&&B){
                if(x.childNodes.length==0||(x.childNodes.length==1&&x.firstChild.nodeName=="BR")){
                    p=x;
                    while((p=p.previousSibling)&&!s.dom.isBlock(p)){}
                    if(p){
                        if(x!=y.firstChild){
                            z=s.dom.doc.createTreeWalker(p,NodeFilter.SHOW_TEXT,null,g);
                            while(A=z.nextNode()){
                                p=A
                            }
                            o=s.getDoc().createRange();
                            o.setStart(p,p.nodeValue?p.nodeValue.length:0);
                            o.setEnd(p,p.nodeValue?p.nodeValue.length:0);
                            v.setRng(o);
                            s.dom.remove(x)
                        }
                        return j.cancel(u)
                    }
                }
            }
        }
    })
})(tinymce);
(function(c){
    var b=c.DOM,a=c.dom.Event,d=c.each,e=c.extend;
    c.create("tinymce.ControlManager",{
        ControlManager:function(f,j){
            var h=this,g;
            j=j||{};
            
            h.editor=f;
            h.controls={};
            
            h.onAdd=new c.util.Dispatcher(h);
            h.onPostRender=new c.util.Dispatcher(h);
            h.prefix=j.prefix||f.id+"_";
            h._cls={};
            
            h.onPostRender.add(function(){
                d(h.controls,function(i){
                    i.postRender()
                })
            })
        },
        get:function(f){
            return this.controls[this.prefix+f]||this.controls[f]
        },
        setActive:function(h,f){
            var g=null;
            if(g=this.get(h)){
                g.setActive(f)
            }
            return g
        },
        setDisabled:function(h,f){
            var g=null;
            if(g=this.get(h)){
                g.setDisabled(f)
            }
            return g
        },
        add:function(g){
            var f=this;
            if(g){
                f.controls[g.id]=g;
                f.onAdd.dispatch(g,f)
            }
            return g
        },
        createControl:function(i){
            var h,g=this,f=g.editor;
            d(f.plugins,function(j){
                if(j.createControl){
                    h=j.createControl(i,g);
                    if(h){
                        return false
                    }
                }
            });
            switch(i){
                case"|":case"separator":
                    return g.createSeparator()
            }
            if(!h&&f.buttons&&(h=f.buttons[i])){
                return g.createButton(i,h)
            }
            return g.add(h)
        },
        createDropMenu:function(f,n,h){
            var m=this,i=m.editor,j,g,k,l;
            n=e({
                "class":"mceDropDown",
                constrain:i.settings.constrain_menus
            },n);
            n["class"]=n["class"]+" "+i.getParam("skin")+"Skin";
            if(k=i.getParam("skin_variant")){
                n["class"]+=" "+i.getParam("skin")+"Skin"+k.substring(0,1).toUpperCase()+k.substring(1)
            }
            f=m.prefix+f;
            l=h||m._cls.dropmenu||c.ui.DropMenu;
            j=m.controls[f]=new l(f,n);
            j.onAddItem.add(function(r,q){
                var p=q.settings;
                p.title=i.getLang(p.title,p.title);
                if(!p.onclick){
                    p.onclick=function(o){
                        if(p.cmd){
                            i.execCommand(p.cmd,p.ui||false,p.value)
                        }
                    }
                }
            });
            i.onRemove.add(function(){
                j.destroy()
            });
            if(c.isIE){
                j.onShowMenu.add(function(){
                    i.focus();
                    g=i.selection.getBookmark(1)
                });
                j.onHideMenu.add(function(){
                    if(g){
                        i.selection.moveToBookmark(g);
                        g=0
                    }
                })
            }
            return m.add(j)
        },
        createListBox:function(m,i,l){
            var h=this,g=h.editor,j,k,f;
            if(h.get(m)){
                return null
            }
            i.title=g.translate(i.title);
            i.scope=i.scope||g;
            if(!i.onselect){
                i.onselect=function(n){
                    g.execCommand(i.cmd,i.ui||false,n||i.value)
                }
            }
            i=e({
                title:i.title,
                "class":"mce_"+m,
                scope:i.scope,
                control_manager:h
            },i);
            m=h.prefix+m;
            if(g.settings.use_native_selects){
                k=new c.ui.NativeListBox(m,i)
            }else{
                f=l||h._cls.listbox||c.ui.ListBox;
                k=new f(m,i,g)
            }
            h.controls[m]=k;
            if(c.isWebKit){
                k.onPostRender.add(function(p,o){
                    a.add(o,"mousedown",function(){
                        g.bookmark=g.selection.getBookmark(1)
                    });
                    a.add(o,"focus",function(){
                        g.selection.moveToBookmark(g.bookmark);
                        g.bookmark=null
                    })
                })
            }
            if(k.hideMenu){
                g.onMouseDown.add(k.hideMenu,k)
            }
            return h.add(k)
        },
        createButton:function(m,i,l){
            var h=this,g=h.editor,j,k,f;
            if(h.get(m)){
                return null
            }
            i.title=g.translate(i.title);
            i.label=g.translate(i.label);
            i.scope=i.scope||g;
            if(!i.onclick&&!i.menu_button){
                i.onclick=function(){
                    g.execCommand(i.cmd,i.ui||false,i.value)
                }
            }
            i=e({
                title:i.title,
                "class":"mce_"+m,
                unavailable_prefix:g.getLang("unavailable",""),
                scope:i.scope,
                control_manager:h
            },i);
            m=h.prefix+m;
            if(i.menu_button){
                f=l||h._cls.menubutton||c.ui.MenuButton;
                k=new f(m,i,g);
                g.onMouseDown.add(k.hideMenu,k)
            }else{
                f=h._cls.button||c.ui.Button;
                k=new f(m,i)
            }
            return h.add(k)
        },
        createMenuButton:function(h,f,g){
            f=f||{};
    
            f.menu_button=1;
            return this.createButton(h,f,g)
        },
        createSplitButton:function(m,i,l){
            var h=this,g=h.editor,j,k,f;
            if(h.get(m)){
                return null
            }
            i.title=g.translate(i.title);
            i.scope=i.scope||g;
            if(!i.onclick){
                i.onclick=function(n){
                    g.execCommand(i.cmd,i.ui||false,n||i.value)
                }
            }
            if(!i.onselect){
                i.onselect=function(n){
                    g.execCommand(i.cmd,i.ui||false,n||i.value)
                }
            }
            i=e({
                title:i.title,
                "class":"mce_"+m,
                scope:i.scope,
                control_manager:h
            },i);
            m=h.prefix+m;
            f=l||h._cls.splitbutton||c.ui.SplitButton;
            k=h.add(new f(m,i,g));
            g.onMouseDown.add(k.hideMenu,k);
            return k
        },
        createColorSplitButton:function(f,n,h){
            var l=this,j=l.editor,i,k,m,g;
            if(l.get(f)){
                return null
            }
            n.title=j.translate(n.title);
            n.scope=n.scope||j;
            if(!n.onclick){
                n.onclick=function(o){
                    if(c.isIE){
                        g=j.selection.getBookmark(1)
                    }
                    j.execCommand(n.cmd,n.ui||false,o||n.value)
                }
            }
            if(!n.onselect){
                n.onselect=function(o){
                    j.execCommand(n.cmd,n.ui||false,o||n.value)
                }
            }
            n=e({
                title:n.title,
                "class":"mce_"+f,
                menu_class:j.getParam("skin")+"Skin",
                scope:n.scope,
                more_colors_title:j.getLang("more_colors")
            },n);
            f=l.prefix+f;
            m=h||l._cls.colorsplitbutton||c.ui.ColorSplitButton;
            k=new m(f,n,j);
            j.onMouseDown.add(k.hideMenu,k);
            j.onRemove.add(function(){
                k.destroy()
            });
            if(c.isIE){
                k.onShowMenu.add(function(){
                    j.focus();
                    g=j.selection.getBookmark(1)
                });
                k.onHideMenu.add(function(){
                    if(g){
                        j.selection.moveToBookmark(g);
                        g=0
                    }
                })
            }
            return l.add(k)
        },
        createToolbar:function(k,h,j){
            var i,g=this,f;
            k=g.prefix+k;
            f=j||g._cls.toolbar||c.ui.Toolbar;
            i=new f(k,h,g.editor);
            if(g.get(k)){
                return null
            }
            return g.add(i)
        },
        createToolbarGroup:function(k,h,j){
            var i,g=this,f;
            k=g.prefix+k;
            f=j||this._cls.toolbarGroup||c.ui.ToolbarGroup;
            i=new f(k,h,g.editor);
            if(g.get(k)){
                return null
            }
            return g.add(i)
        },
        createSeparator:function(g){
            var f=g||this._cls.separator||c.ui.Separator;
            return new f()
        },
        setControlType:function(g,f){
            return this._cls[g.toLowerCase()]=f
        },
        destroy:function(){
            d(this.controls,function(f){
                f.destroy()
            });
            this.controls=null
        }
    })
})(tinymce);
(function(d){
    var a=d.util.Dispatcher,e=d.each,c=d.isIE,b=d.isOpera;
    d.create("tinymce.WindowManager",{
        WindowManager:function(f){
            var g=this;
            g.editor=f;
            g.onOpen=new a(g);
            g.onClose=new a(g);
            g.params={};
            
            g.features={}
        },
        open:function(z,h){
            var v=this,k="",n,m,i=v.editor.settings.dialog_type=="modal",q,o,j,g=d.DOM.getViewPort(),r;
            z=z||{};
        
            h=h||{};
        
            o=b?g.w:screen.width;
            j=b?g.h:screen.height;
            z.name=z.name||"mc_"+new Date().getTime();
            z.width=parseInt(z.width||320);
            z.height=parseInt(z.height||240);
            z.resizable=true;
            z.left=z.left||parseInt(o/2)-(z.width/2);
            z.top=z.top||parseInt(j/2)-(z.height/2);
            h.inline=false;
            h.mce_width=z.width;
            h.mce_height=z.height;
            h.mce_auto_focus=z.auto_focus;
            if(i){
                if(c){
                    z.center=true;
                    z.help=false;
                    z.dialogWidth=z.width+"px";
                    z.dialogHeight=z.height+"px";
                    z.scroll=z.scrollbars||false
                }
            }
            e(z,function(p,f){
                if(d.is(p,"boolean")){
                    p=p?"yes":"no"
                }
                if(!/^(name|url)$/.test(f)){
                    if(c&&i){
                        k+=(k?";":"")+f+":"+p
                    }else{
                        k+=(k?",":"")+f+"="+p
                    }
                }
            });
            v.features=z;
            v.params=h;
            v.onOpen.dispatch(v,z,h);
            r=z.url||z.file;
            r=d._addVer(r);
            try{
                if(c&&i){
                    q=1;
                    window.showModalDialog(r,window,k)
                }else{
                    q=window.open(r,z.name,k)
                }
            }catch(l){}
            if(!q){
                alert(v.editor.getLang("popup_blocked"))
            }
        },
        close:function(f){
            f.close();
            this.onClose.dispatch(this)
        },
        createInstance:function(i,h,g,m,l,k){
            var j=d.resolve(i);
            return new j(h,g,m,l,k)
        },
        confirm:function(h,f,i,g){
            g=g||window;
            f.call(i||this,g.confirm(this._decode(this.editor.getLang(h,h))))
        },
        alert:function(h,f,j,g){
            var i=this;
            g=g||window;
            g.alert(i._decode(i.editor.getLang(h,h)));
            if(f){
                f.call(j||i)
            }
        },
        resizeBy:function(f,g,h){
            h.resizeBy(f,g)
        },
        _decode:function(f){
            return d.DOM.decode(f).replace(/\\n/g,"\n")
        }
    })
}(tinymce));
(function(a){
    a.Formatter=function(V){
        var M={},O=a.each,c=V.dom,q=V.selection,t=a.dom.TreeWalker,K=new a.dom.RangeUtils(c),d=V.schema.isValidChild,F=c.isBlock,l=V.settings.forced_root_block,s=c.nodeIndex,E="\uFEFF",e=/^(src|href|style)$/,S=false,B=true,p,P={
            apply:[],
            remove:[]
        };
        
        function z(W){
            return W instanceof Array
        }
        function m(X,W){
            return c.getParents(X,W,c.getRoot())
        }
        function b(W){
            return W.nodeType===1&&(W.face==="mceinline"||W.style.fontFamily==="mceinline")
        }
        function R(W){
            return W?M[W]:M
        }
        function k(W,X){
            if(W){
                if(typeof(W)!=="string"){
                    O(W,function(Z,Y){
                        k(Y,Z)
                    })
                }else{
                    X=X.length?X:[X];
                    O(X,function(Y){
                        if(Y.deep===p){
                            Y.deep=!Y.selector
                        }
                        if(Y.split===p){
                            Y.split=!Y.selector||Y.inline
                        }
                        if(Y.remove===p&&Y.selector&&!Y.inline){
                            Y.remove="none"
                        }
                        if(Y.selector&&Y.inline){
                            Y.mixed=true;
                            Y.block_expand=true
                        }
                        if(typeof(Y.classes)==="string"){
                            Y.classes=Y.classes.split(/\s+/)
                        }
                    });
                    M[W]=X
                }
            }
        }
        var i=function(X){
            var W;
            V.dom.getParent(X,function(Y){
                W=V.dom.getStyle(Y,"text-decoration");
                return W&&W!=="none"
            });
            return W
        };
    
        var I=function(W){
            var X;
            if(W.nodeType===1&&W.parentNode&&W.parentNode.nodeType===1){
                X=i(W.parentNode);
                if(V.dom.getStyle(W,"color")&&X){
                    V.dom.setStyle(W,"text-decoration",X)
                }else{
                    if(V.dom.getStyle(W,"textdecoration")===X){
                        V.dom.setStyle(W,"text-decoration",null)
                    }
                }
            }
        };

        function T(Y,af,aa){
            var ab=R(Y),ag=ab[0],ae,X,ad,ac=q.isCollapsed();
            function Z(ak){
                var aj=ak.startContainer,an=ak.startOffset,am,al;
                if(aj.nodeType==1||aj.nodeValue===""){
                    aj=aj.nodeType==1?aj.childNodes[an]:aj;
                    if(aj){
                        am=new t(aj,aj.parentNode);
                        for(al=am.current();al;al=am.next()){
                            if(al.nodeType==3&&!f(al)){
                                ak.setStart(al,0);
                                break
                            }
                        }
                    }
                }
                return ak
            }
            function W(ak,aj){
                aj=aj||ag;
                if(ak){
                    O(aj.styles,function(am,al){
                        c.setStyle(ak,al,r(am,af))
                    });
                    O(aj.attributes,function(am,al){
                        c.setAttrib(ak,al,r(am,af))
                    });
                    O(aj.classes,function(al){
                        al=r(al,af);
                        if(!c.hasClass(ak,al)){
                            c.addClass(ak,al)
                        }
                    })
                }
            }
            function ah(ak){
                var aj=[],am,al;
                am=ag.inline||ag.block;
                al=c.create(am);
                W(al);
                K.walk(ak,function(an){
                    var ao;
                    function ap(aq){
                        var au=aq.nodeName.toLowerCase(),at=aq.parentNode.nodeName.toLowerCase(),ar;
                        if(g(au,"br")){
                            ao=0;
                            if(ag.block){
                                c.remove(aq)
                            }
                            return
                        }
                        if(ag.wrapper&&x(aq,Y,af)){
                            ao=0;
                            return
                        }
                        if(ag.block&&!ag.wrapper&&G(au)){
                            aq=c.rename(aq,am);
                            W(aq);
                            aj.push(aq);
                            ao=0;
                            return
                        }
                        if(ag.selector){
                            O(ab,function(av){
                                if("collapsed" in av&&av.collapsed!==ac){
                                    return
                                }
                                if(c.is(aq,av.selector)&&!b(aq)){
                                    W(aq,av);
                                    ar=true
                                }
                            });
                            if(!ag.inline||ar){
                                ao=0;
                                return
                            }
                        }
                        if(d(am,au)&&d(at,am)&&!(aq.nodeType===3&&aq.nodeValue.length===1&&aq.nodeValue.charCodeAt(0)===65279)){
                            if(!ao){
                                ao=al.cloneNode(S);
                                aq.parentNode.insertBefore(ao,aq);
                                aj.push(ao)
                            }
                            ao.appendChild(aq)
                        }else{
                            ao=0;
                            O(a.grep(aq.childNodes),ap);
                            ao=0
                        }
                    }
                    O(an,ap)
                });
                if(ag.wrap_links===false){
                    O(aj,function(an){
                        function ao(at){
                            var ar,aq,ap;
                            if(at.nodeName==="A"){
                                aq=al.cloneNode(S);
                                aj.push(aq);
                                ap=a.grep(at.childNodes);
                                for(ar=0;ar<ap.length;ar++){
                                    aq.appendChild(ap[ar])
                                }
                                at.appendChild(aq)
                            }
                            O(a.grep(at.childNodes),ao)
                        }
                        ao(an)
                    })
                }
                O(aj,function(ap){
                    var an;
                    function aq(at){
                        var ar=0;
                        O(at.childNodes,function(au){
                            if(!f(au)&&!H(au)){
                                ar++
                            }
                        });
                        return ar
                    }
                    function ao(ar){
                        var au,at;
                        O(ar.childNodes,function(av){
                            if(av.nodeType==1&&!H(av)&&!b(av)){
                                au=av;
                                return S
                            }
                        });
                        if(au&&h(au,ag)){
                            at=au.cloneNode(S);
                            W(at);
                            c.replace(at,ar,B);
                            c.remove(au,1)
                        }
                        return at||ar
                    }
                    an=aq(ap);
                    if((aj.length>1||!F(ap))&&an===0){
                        c.remove(ap,1);
                        return
                    }
                    if(ag.inline||ag.wrapper){
                        if(!ag.exact&&an===1){
                            ap=ao(ap)
                        }
                        O(ab,function(ar){
                            O(c.select(ar.inline,ap),function(au){
                                var at;
                                if(ar.wrap_links===false){
                                    at=au.parentNode;
                                    do{
                                        if(at.nodeName==="A"){
                                            return
                                        }
                                    }while(at=at.parentNode)
                                }
                                U(ar,af,au,ar.exact?au:null)
                            })
                        });
                        if(x(ap.parentNode,Y,af)){
                            c.remove(ap,1);
                            ap=0;
                            return B
                        }
                        if(ag.merge_with_parents){
                            c.getParent(ap.parentNode,function(ar){
                                if(x(ar,Y,af)){
                                    c.remove(ap,1);
                                    ap=0;
                                    return B
                                }
                            })
                        }
                        if(ap){
                            ap=u(C(ap),ap);
                            ap=u(ap,C(ap,B))
                        }
                    }
                })
            }
            if(ag){
                if(aa){
                    X=c.createRng();
                    X.setStartBefore(aa);
                    X.setEndAfter(aa);
                    ah(o(X,ab))
                }else{
                    if(!ac||!ag.inline||c.select("td.mceSelected,th.mceSelected").length){
                        var ai=V.selection.getNode();
                        ae=q.getBookmark();
                        ah(o(q.getRng(B),ab));
                        if(ag.styles&&(ag.styles.color||ag.styles.textDecoration)){
                            a.walk(ai,I,"childNodes");
                            I(ai)
                        }
                        q.moveToBookmark(ae);
                        q.setRng(Z(q.getRng(B)));
                        V.nodeChanged()
                    }else{
                        Q("apply",Y,af)
                    }
                }
            }
        }
        function A(Y,ah,ab){
            var ac=R(Y),aj=ac[0],ag,af,X;
            function aa(am){
                var al=am.startContainer,ar=am.startOffset,aq,ap,an,ao;
                if(al.nodeType==3&&ar>=al.nodeValue.length-1){
                    al=al.parentNode;
                    ar=s(al)+1
                }
                if(al.nodeType==1){
                    an=al.childNodes;
                    al=an[Math.min(ar,an.length-1)];
                    aq=new t(al);
                    if(ar>an.length-1){
                        aq.next()
                    }
                    for(ap=aq.current();ap;ap=aq.next()){
                        if(ap.nodeType==3&&!f(ap)){
                            ao=c.create("a",null,E);
                            ap.parentNode.insertBefore(ao,ap);
                            am.setStart(ap,0);
                            q.setRng(am);
                            c.remove(ao);
                            return
                        }
                    }
                }
            }
            function Z(ao){
                var an,am,al;
                an=a.grep(ao.childNodes);
                for(am=0,al=ac.length;am<al;am++){
                    if(U(ac[am],ah,ao,ao)){
                        break
                    }
                }
                if(aj.deep){
                    for(am=0,al=an.length;am<al;am++){
                        Z(an[am])
                    }
                }
            }
            function ad(al){
                var am;
                O(m(al.parentNode).reverse(),function(an){
                    var ao;
                    if(!am&&an.id!="_start"&&an.id!="_end"){
                        ao=x(an,Y,ah);
                        if(ao&&ao.split!==false){
                            am=an
                        }
                    }
                });
                return am
            }
            function W(ao,al,aq,au){
                var av,at,ar,an,ap,am;
                if(ao){
                    am=ao.parentNode;
                    for(av=al.parentNode;av&&av!=am;av=av.parentNode){
                        at=av.cloneNode(S);
                        for(ap=0;ap<ac.length;ap++){
                            if(U(ac[ap],ah,at,at)){
                                at=0;
                                break
                            }
                        }
                        if(at){
                            if(ar){
                                at.appendChild(ar)
                            }
                            if(!an){
                                an=at
                            }
                            ar=at
                        }
                    }
                    if(au&&(!aj.mixed||!F(ao))){
                        al=c.split(ao,al)
                    }
                    if(ar){
                        aq.parentNode.insertBefore(ar,aq);
                        an.appendChild(aq)
                    }
                }
                return al
            }
            function ai(al){
                return W(ad(al),al,al,true)
            }
            function ae(an){
                var am=c.get(an?"_start":"_end"),al=am[an?"firstChild":"lastChild"];
                if(H(al)){
                    al=al[an?"firstChild":"lastChild"]
                }
                c.remove(am,true);
                return al
            }
            function ak(al){
                var am,an;
                al=o(al,ac,B);
                if(aj.split){
                    am=J(al,B);
                    an=J(al);
                    if(am!=an){
                        am=N(am,"span",{
                            id:"_start",
                            "data-mce-type":"bookmark"
                        });
                        an=N(an,"span",{
                            id:"_end",
                            "data-mce-type":"bookmark"
                        });
                        ai(am);
                        ai(an);
                        am=ae(B);
                        an=ae()
                    }else{
                        am=an=ai(am)
                    }
                    al.startContainer=am.parentNode;
                    al.startOffset=s(am);
                    al.endContainer=an.parentNode;
                    al.endOffset=s(an)+1
                }
                K.walk(al,function(ao){
                    O(ao,function(ap){
                        Z(ap);
                        if(ap.nodeType===1&&V.dom.getStyle(ap,"text-decoration")==="underline"&&ap.parentNode&&i(ap.parentNode)==="underline"){
                            U({
                                deep:false,
                                exact:true,
                                inline:"span",
                                styles:{
                                    textDecoration:"underline"
                                }
                            },null,ap)
                        }
                    })
                })
            }
            if(ab){
                X=c.createRng();
                X.setStartBefore(ab);
                X.setEndAfter(ab);
                ak(X);
                return
            }
            if(!q.isCollapsed()||!aj.inline||c.select("td.mceSelected,th.mceSelected").length){
                ag=q.getBookmark();
                ak(q.getRng(B));
                q.moveToBookmark(ag);
                if(j(Y,ah,q.getStart())){
                    aa(q.getRng(true))
                }
                V.nodeChanged()
            }else{
                Q("remove",Y,ah)
            }
        }
        function D(X,Z,Y){
            var W=R(X);
            if(j(X,Z,Y)&&(!("toggle" in W[0])||W[0]["toggle"])){
                A(X,Z,Y)
            }else{
                T(X,Z,Y)
            }
        }
        function x(X,W,ac,aa){
            var Y=R(W),ad,ab,Z;
            function ae(ai,ak,al){
                var ah,aj,af=ak[al],ag;
                if(af){
                    if(af.length===p){
                        for(ah in af){
                            if(af.hasOwnProperty(ah)){
                                if(al==="attributes"){
                                    aj=c.getAttrib(ai,ah)
                                }else{
                                    aj=L(ai,ah)
                                }
                                if(aa&&!aj&&!ak.exact){
                                    return
                                }
                                if((!aa||ak.exact)&&!g(aj,r(af[ah],ac))){
                                    return
                                }
                            }
                        }
                    }else{
                        for(ag=0;ag<af.length;ag++){
                            if(al==="attributes"?c.getAttrib(ai,af[ag]):L(ai,af[ag])){
                                return ak
                            }
                        }
                    }
                }
                return ak
            }
            if(Y&&X){
                for(ab=0;ab<Y.length;ab++){
                    ad=Y[ab];
                    if(h(X,ad)&&ae(X,ad,"attributes")&&ae(X,ad,"styles")){
                        if(Z=ad.classes){
                            for(ab=0;ab<Z.length;ab++){
                                if(!c.hasClass(X,Z[ab])){
                                    return
                                }
                            }
                        }
                        return ad
                    }
                }
            }
        }
        function j(Y,ab,aa){
            var X,Z;
            function W(ac){
                ac=c.getParent(ac,function(ad){
                    return !!x(ad,Y,ab,true)
                });
                return x(ac,Y,ab)
            }
            if(aa){
                return W(aa)
            }
            if(q.isCollapsed()){
                for(Z=P.apply.length-1;Z>=0;Z--){
                    if(P.apply[Z].name==Y){
                        return true
                    }
                }
                for(Z=P.remove.length-1;Z>=0;Z--){
                    if(P.remove[Z].name==Y){
                        return false
                    }
                }
                return W(q.getNode())
            }
            aa=q.getNode();
            if(W(aa)){
                return B
            }
            X=q.getStart();
            if(X!=aa){
                if(W(X)){
                    return B
                }
            }
            return S
        }
        function v(ad,ac){
            var aa,ab=[],Z={},Y,X,W;
            if(q.isCollapsed()){
                for(X=0;X<ad.length;X++){
                    for(Y=P.remove.length-1;Y>=0;Y--){
                        W=ad[X];
                        if(P.remove[Y].name==W){
                            Z[W]=true;
                            break
                        }
                    }
                }
                for(Y=P.apply.length-1;Y>=0;Y--){
                    for(X=0;X<ad.length;X++){
                        W=ad[X];
                        if(!Z[W]&&P.apply[Y].name==W){
                            Z[W]=true;
                            ab.push(W)
                        }
                    }
                }
            }
            aa=q.getStart();
            c.getParent(aa,function(ag){
                var af,ae;
                for(af=0;af<ad.length;af++){
                    ae=ad[af];
                    if(!Z[ae]&&x(ag,ae,ac)){
                        Z[ae]=true;
                        ab.push(ae)
                    }
                }
            });
            return ab
        }
        function y(aa){
            var ac=R(aa),Z,Y,ab,X,W;
            if(ac){
                Z=q.getStart();
                Y=m(Z);
                for(X=ac.length-1;X>=0;X--){
                    W=ac[X].selector;
                    if(!W){
                        return B
                    }
                    for(ab=Y.length-1;ab>=0;ab--){
                        if(c.is(Y[ab],W)){
                            return B
                        }
                    }
                }
            }
            return S
        }
        a.extend(this,{
            get:R,
            register:k,
            apply:T,
            remove:A,
            toggle:D,
            match:j,
            matchAll:v,
            matchNode:x,
            canApply:y
        });
        function h(W,X){
            if(g(W,X.inline)){
                return B
            }
            if(g(W,X.block)){
                return B
            }
            if(X.selector){
                return c.is(W,X.selector)
            }
        }
        function g(X,W){
            X=X||"";
            W=W||"";
            X=""+(X.nodeName||X);
            W=""+(W.nodeName||W);
            return X.toLowerCase()==W.toLowerCase()
        }
        function L(X,W){
            var Y=c.getStyle(X,W);
            if(W=="color"||W=="backgroundColor"){
                Y=c.toHex(Y)
            }
            if(W=="fontWeight"&&Y==700){
                Y="bold"
            }
            return""+Y
        }
        function r(W,X){
            if(typeof(W)!="string"){
                W=W(X)
            }else{
                if(X){
                    W=W.replace(/%(\w+)/g,function(Z,Y){
                        return X[Y]||Z
                    })
                }
            }
            return W
        }
        function f(W){
            return W&&W.nodeType===3&&/^([\s\r\n]+|)$/.test(W.nodeValue)
        }
        function N(Y,X,W){
            var Z=c.create(X,W);
            Y.parentNode.insertBefore(Z,Y);
            Z.appendChild(Y);
            return Z
        }
        function o(W,ag,Z){
            var Y=W.startContainer,ad=W.startOffset,aj=W.endContainer,ae=W.endOffset,ai,af,ac;
            function ah(am,an,ak,al){
                var ao,ap;
                al=al||c.getRoot();
                for(;;){
                    ao=am.parentNode;
                    if(ao==al||(!ag[0].block_expand&&F(ao))){
                        return am
                    }
                    for(ai=ao[an];ai&&ai!=am;ai=ai[ak]){
                        if(ai.nodeType==1&&!H(ai)){
                            return am
                        }
                        if(ai.nodeType==3&&!f(ai)){
                            return am
                        }
                    }
                    am=am.parentNode
                }
                return am
            }
            function ab(ak,al){
                if(al===p){
                    al=ak.nodeType===3?ak.length:ak.childNodes.length
                }while(ak&&ak.hasChildNodes()){
                    ak=ak.childNodes[al];
                    if(ak){
                        al=ak.nodeType===3?ak.length:ak.childNodes.length
                    }
                }
                return{
                    node:ak,
                    offset:al
                }
            }
            if(Y.nodeType==1&&Y.hasChildNodes()){
                af=Y.childNodes.length-1;
                Y=Y.childNodes[ad>af?af:ad];
                if(Y.nodeType==3){
                    ad=0
                }
            }
            if(aj.nodeType==1&&aj.hasChildNodes()){
                af=aj.childNodes.length-1;
                aj=aj.childNodes[ae>af?af:ae-1];
                if(aj.nodeType==3){
                    ae=aj.nodeValue.length
                }
            }
            if(H(Y.parentNode)){
                Y=Y.parentNode
            }
            if(H(Y)){
                Y=Y.nextSibling||Y
            }
            if(H(aj.parentNode)){
                ae=c.nodeIndex(aj);
                aj=aj.parentNode
            }
            if(H(aj)&&aj.previousSibling){
                aj=aj.previousSibling;
                ae=aj.length
            }
            if(ag[0].inline){
                ac=ab(aj,ae);
                if(ac.node){
                    while(ac.node&&ac.offset===0&&ac.node.previousSibling){
                        ac=ab(ac.node.previousSibling)
                    }
                    if(ac.node&&ac.offset>0&&ac.node.nodeType===3&&ac.node.nodeValue.charAt(ac.offset-1)===" "){
                        if(ac.offset>1){
                            aj=ac.node;
                            aj.splitText(ac.offset-1)
                        }else{
                            if(ac.node.previousSibling){
                                aj=ac.node.previousSibling
                            }
                        }
                    }
                }
            }
            if(ag[0].inline||ag[0].block_expand){
                Y=ah(Y,"firstChild","nextSibling");
                aj=ah(aj,"lastChild","previousSibling")
            }
            if(ag[0].selector&&ag[0].expand!==S&&!ag[0].inline){
                function aa(al,ak){
                    var am,an,ap,ao;
                    if(al.nodeType==3&&al.nodeValue.length==0&&al[ak]){
                        al=al[ak]
                    }
                    am=m(al);
                    for(an=0;an<am.length;an++){
                        for(ap=0;ap<ag.length;ap++){
                            ao=ag[ap];
                            if("collapsed" in ao&&ao.collapsed!==W.collapsed){
                                continue
                            }
                            if(c.is(am[an],ao.selector)){
                                return am[an]
                            }
                        }
                    }
                    return al
                }
                Y=aa(Y,"previousSibling");
                aj=aa(aj,"nextSibling")
            }
            if(ag[0].block||ag[0].selector){
                function X(al,ak,an){
                    var am;
                    if(!ag[0].wrapper){
                        am=c.getParent(al,ag[0].block)
                    }
                    if(!am){
                        am=c.getParent(al.nodeType==3?al.parentNode:al,F)
                    }
                    if(am&&ag[0].wrapper){
                        am=m(am,"ul,ol").reverse()[0]||am
                    }
                    if(!am){
                        am=al;
                        while(am[ak]&&!F(am[ak])){
                            am=am[ak];
                            if(g(am,"br")){
                                break
                            }
                        }
                    }
                    return am||al
                }
                Y=X(Y,"previousSibling");
                aj=X(aj,"nextSibling");
                if(ag[0].block){
                    if(!F(Y)){
                        Y=ah(Y,"firstChild","nextSibling")
                    }
                    if(!F(aj)){
                        aj=ah(aj,"lastChild","previousSibling")
                    }
                }
            }
            if(Y.nodeType==1){
                ad=s(Y);
                Y=Y.parentNode
            }
            if(aj.nodeType==1){
                ae=s(aj)+1;
                aj=aj.parentNode
            }
            return{
                startContainer:Y,
                startOffset:ad,
                endContainer:aj,
                endOffset:ae
            }
        }
        function U(ac,ab,Z,W){
            var Y,X,aa;
            if(!h(Z,ac)){
                return S
            }
            if(ac.remove!="all"){
                O(ac.styles,function(ae,ad){
                    ae=r(ae,ab);
                    if(typeof(ad)==="number"){
                        ad=ae;
                        W=0
                    }
                    if(!W||g(L(W,ad),ae)){
                        c.setStyle(Z,ad,"")
                    }
                    aa=1
                });
                if(aa&&c.getAttrib(Z,"style")==""){
                    Z.removeAttribute("style");
                    Z.removeAttribute("data-mce-style")
                }
                O(ac.attributes,function(af,ad){
                    var ae;
                    af=r(af,ab);
                    if(typeof(ad)==="number"){
                        ad=af;
                        W=0
                    }
                    if(!W||g(c.getAttrib(W,ad),af)){
                        if(ad=="class"){
                            af=c.getAttrib(Z,ad);
                            if(af){
                                ae="";
                                O(af.split(/\s+/),function(ag){
                                    if(/mce\w+/.test(ag)){
                                        ae+=(ae?" ":"")+ag
                                    }
                                });
                                if(ae){
                                    c.setAttrib(Z,ad,ae);
                                    return
                                }
                            }
                        }
                        if(ad=="class"){
                            Z.removeAttribute("className")
                        }
                        if(e.test(ad)){
                            Z.removeAttribute("data-mce-"+ad)
                        }
                        Z.removeAttribute(ad)
                    }
                });
                O(ac.classes,function(ad){
                    ad=r(ad,ab);
                    if(!W||c.hasClass(W,ad)){
                        c.removeClass(Z,ad)
                    }
                });
                X=c.getAttribs(Z);
                for(Y=0;Y<X.length;Y++){
                    if(X[Y].nodeName.indexOf("_")!==0){
                        return S
                    }
                }
            }
            if(ac.remove!="none"){
                n(Z,ac);
                return B
            }
        }
        function n(Y,Z){
            var W=Y.parentNode,X;
            if(Z.block){
                if(!l){
                    function aa(ac,ab,ad){
                        ac=C(ac,ab,ad);
                        return !ac||(ac.nodeName=="BR"||F(ac))
                    }
                    if(F(Y)&&!F(W)){
                        if(!aa(Y,S)&&!aa(Y.firstChild,B,1)){
                            Y.insertBefore(c.create("br"),Y.firstChild)
                        }
                        if(!aa(Y,B)&&!aa(Y.lastChild,S,1)){
                            Y.appendChild(c.create("br"))
                        }
                    }
                }else{
                    if(W==c.getRoot()){
                        if(!Z.list_block||!g(Y,Z.list_block)){
                            O(a.grep(Y.childNodes),function(ab){
                                if(d(l,ab.nodeName.toLowerCase())){
                                    if(!X){
                                        X=N(ab,l)
                                    }else{
                                        X.appendChild(ab)
                                    }
                                }else{
                                    X=0
                                }
                            })
                        }
                    }
                }
            }
            if(Z.selector&&Z.inline&&!g(Z.inline,Y)){
                return
            }
            c.remove(Y,1)
        }
        function C(X,W,Y){
            if(X){
                W=W?"nextSibling":"previousSibling";
                for(X=Y?X:X[W];X;X=X[W]){
                    if(X.nodeType==1||!f(X)){
                        return X
                    }
                }
            }
        }
        function H(W){
            return W&&W.nodeType==1&&W.getAttribute("data-mce-type")=="bookmark"
        }
        function u(aa,Z){
            var W,Y,X;
            function ac(af,ae){
                if(af.nodeName!=ae.nodeName){
                    return S
                }
                function ad(ah){
                    var ai={};
            
                    O(c.getAttribs(ah),function(aj){
                        var ak=aj.nodeName.toLowerCase();
                        if(ak.indexOf("_")!==0&&ak!=="style"){
                            ai[ak]=c.getAttrib(ah,ak)
                        }
                    });
                    return ai
                }
                function ag(ak,aj){
                    var ai,ah;
                    for(ah in ak){
                        if(ak.hasOwnProperty(ah)){
                            ai=aj[ah];
                            if(ai===p){
                                return S
                            }
                            if(ak[ah]!=ai){
                                return S
                            }
                            delete aj[ah]
                        }
                    }
                    for(ah in aj){
                        if(aj.hasOwnProperty(ah)){
                            return S
                        }
                    }
                    return B
                }
                if(!ag(ad(af),ad(ae))){
                    return S
                }
                if(!ag(c.parseStyle(c.getAttrib(af,"style")),c.parseStyle(c.getAttrib(ae,"style")))){
                    return S
                }
                return B
            }
            if(aa&&Z){
                function ab(ae,ad){
                    for(Y=ae;Y;Y=Y[ad]){
                        if(Y.nodeType==3&&Y.nodeValue.length!==0){
                            return ae
                        }
                        if(Y.nodeType==1&&!H(Y)){
                            return Y
                        }
                    }
                    return ae
                }
                aa=ab(aa,"previousSibling");
                Z=ab(Z,"nextSibling");
                if(ac(aa,Z)){
                    for(Y=aa.nextSibling;Y&&Y!=Z;){
                        X=Y;
                        Y=Y.nextSibling;
                        aa.appendChild(X)
                    }
                    c.remove(Z);
                    O(a.grep(Z.childNodes),function(ad){
                        aa.appendChild(ad)
                    });
                    return aa
                }
            }
            return Z
        }
        function G(W){
            return/^(h[1-6]|p|div|pre|address|dl|dt|dd)$/.test(W)
        }
        function J(X,aa){
            var W,Z,Y;
            W=X[aa?"startContainer":"endContainer"];
            Z=X[aa?"startOffset":"endOffset"];
            if(W.nodeType==1){
                Y=W.childNodes.length-1;
                if(!aa&&Z){
                    Z--
                }
                W=W.childNodes[Z>Y?Y:Z]
            }
            return W
        }
        function Q(ab,X,aa){
            var Y,W=P[ab],ac=P[ab=="apply"?"remove":"apply"];
            function ad(){
                return P.apply.length||P.remove.length
            }
            function Z(){
                P.apply=[];
                P.remove=[]
            }
            function ae(af){
                O(P.apply.reverse(),function(ag){
                    T(ag.name,ag.vars,af);
                    if(ag.name==="forecolor"&&ag.vars.value){
                        I(af.parentNode)
                    }
                });
                O(P.remove.reverse(),function(ag){
                    A(ag.name,ag.vars,af)
                });
                c.remove(af,1);
                Z()
            }
            for(Y=W.length-1;Y>=0;Y--){
                if(W[Y].name==X){
                    return
                }
            }
            W.push({
                name:X,
                vars:aa
            });
            for(Y=ac.length-1;Y>=0;Y--){
                if(ac[Y].name==X){
                    ac.splice(Y,1)
                }
            }
            if(ad()){
                V.getDoc().execCommand("FontName",false,"mceinline");
                P.lastRng=q.getRng();
                O(c.select("font,span"),function(ag){
                    var af;
                    if(b(ag)){
                        af=q.getBookmark();
                        ae(ag);
                        q.moveToBookmark(af);
                        V.nodeChanged()
                    }
                });
                if(!P.isListening&&ad()){
                    P.isListening=true;
                    O("onKeyDown,onKeyUp,onKeyPress,onMouseUp".split(","),function(af){
                        V[af].addToTop(function(ag,ah){
                            if(ad()&&!a.dom.RangeUtils.compareRanges(P.lastRng,q.getRng())){
                                O(c.select("font,span"),function(aj){
                                    var ak,ai;
                                    if(b(aj)){
                                        ak=aj.firstChild;
                                        if(ak){
                                            ae(aj);
                                            ai=c.createRng();
                                            ai.setStart(ak,ak.nodeValue.length);
                                            ai.setEnd(ak,ak.nodeValue.length);
                                            q.setRng(ai);
                                            ag.nodeChanged()
                                        }else{
                                            c.remove(aj)
                                        }
                                    }
                                });
                                if(ah.type=="keyup"||ah.type=="mouseup"){
                                    Z()
                                }
                            }
                        })
                    })
                }
            }
        }
    }
})(tinymce);
tinymce.onAddEditor.add(function(e,a){
    var d,h,g,c=a.settings;
    if(c.inline_styles){
        h=e.explode(c.font_size_style_values);
        function b(j,i){
            e.each(i,function(l,k){
                if(l){
                    g.setStyle(j,k,l)
                }
            });
            g.rename(j,"span")
        }
        d={
            font:function(j,i){
                b(i,{
                    backgroundColor:i.style.backgroundColor,
                    color:i.color,
                    fontFamily:i.face,
                    fontSize:h[parseInt(i.size)-1]
                })
            },
            u:function(j,i){
                b(i,{
                    textDecoration:"underline"
                })
            },
            strike:function(j,i){
                b(i,{
                    textDecoration:"line-through"
                })
            }
        };
    
        function f(i,j){
            g=i.dom;
            if(c.convert_fonts_to_spans){
                e.each(g.select("font,u,strike",j.node),function(k){
                    d[k.nodeName.toLowerCase()](a.dom,k)
                })
            }
        }
        a.onPreProcess.add(f);
        a.onSetContent.add(f);
        a.onInit.add(function(){
            a.selection.onSetContent.add(f)
        })
    }
});