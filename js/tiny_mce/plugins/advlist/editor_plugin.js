(function(){
    var a=tinymce.each;
    tinymce.create("tinymce.plugins.AdvListPlugin",{
        init:function(b,c){
            var d=this;
            d.editor=b;
            function e(g){
                var f=[];
                a(g.split(/,/),function(h){
                    f.push({
                        title:"advlist."+(h=="default"?"def":h.replace(/-/g,"_")),
                        styles:{
                            listStyleType:h=="default"?"":h
                        }
                    })
                });
                return f
            }
            d.numlist=b.getParam("advlist_number_styles")||e("default,lower-alpha,lower-greek,lower-roman,upper-alpha,upper-roman");
            d.bullist=b.getParam("advlist_bullet_styles")||e("default,circle,disc,square");
            if(tinymce.isIE&&/MSIE [2-7]/.test(navigator.userAgent)){
                d.isIE7=true
            }
        },
        createControl:function(d,b){
            var f=this,e,h;
            if(d=="numlist"||d=="bullist"){
                if(f[d][0].title=="advlist.def"){
                    h=f[d][0]
                }
                function c(i,k){
                    var j=true;
                    a(k.styles,function(m,l){
                        if(f.editor.dom.getStyle(i,l)!=m){
                            j=false;
                            return false
                        }
                    });
                    return j
                }
                function g(){
                    var k,i=f.editor,l=i.dom,j=i.selection;
                    k=l.getParent(j.getNode(),"ol,ul");
                    if(!k||k.nodeName==(d=="bullist"?"OL":"UL")||c(k,h)){
                        i.execCommand(d=="bullist"?"InsertUnorderedList":"InsertOrderedList")
                    }
                    if(h){
                        k=l.getParent(j.getNode(),"ol,ul");
                        if(k){
                            l.setStyles(k,h.styles);
                            k.removeAttribute("data-mce-style")
                        }
                    }
                    i.focus()
                }
                e=b.createSplitButton(d,{
                    title:"advanced."+d+"_desc",
                    "class":"mce_"+d,
                    onclick:function(){
                        g()
                    }
                });
                e.onRenderMenu.add(function(i,j){
                    j.onShowMenu.add(function(){
                        var m=f.editor.dom,l=m.getParent(f.editor.selection.getNode(),"ol,ul"),k;
                        if(l||h){
                            k=f[d];
                            a(j.items,function(n){
                                var o=true;
                                n.setSelected(0);
                                if(l&&!n.isDisabled()){
                                    a(k,function(p){
                                        if(p.id==n.id){
                                            if(!c(l,p)){
                                                o=false;
                                                return false
                                            }
                                        }
                                    });
                                    if(o){
                                        n.setSelected(1)
                                    }
                                }
                            });
                            if(!l){
                                j.items[h.id].setSelected(1)
                            }
                        }
                    });
                    j.add({
                        id:f.editor.dom.uniqueId(),
                        title:"advlist.types",
                        "class":"mceMenuItemTitle",
                        titleItem:true
                    }).setDisabled(1);
                    a(f[d],function(k){
                        if(f.isIE7&&k.styles.listStyleType=="lower-greek"){
                            return
                        }
                        k.id=f.editor.dom.uniqueId();
                        j.add({
                            id:k.id,
                            title:k.title,
                            onclick:function(){
                                h=k;
                                g()
                            }
                        })
                    })
                });
                return e
            }
        },
        getInfo:function(){
            return{
                longname:"Advanced lists",
                author:"Moxiecode Systems AB",
                authorurl:"http://tinymce.moxiecode.com",
                infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/advlist",
                version:tinymce.majorVersion+"."+tinymce.minorVersion
            }
        }
    });
    tinymce.PluginManager.add("advlist",tinymce.plugins.AdvListPlugin)
})();