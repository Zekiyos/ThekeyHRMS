(function(){
    tinymce.create("tinymce.plugins.BBCodePlugin",{
        init:function(a,b){
            var d=this,c=a.getParam("bbcode_dialect","punbb").toLowerCase();
            a.onBeforeSetContent.add(function(e,f){
                f.content=d["_"+c+"_bbcode2html"](f.content)
            });
            a.onPostProcess.add(function(e,f){
                if(f.set){
                    f.content=d["_"+c+"_bbcode2html"](f.content)
                }
                if(f.get){
                    f.content=d["_"+c+"_html2bbcode"](f.content)
                }
            })
        },
        getInfo:function(){
            return{
                longname:"BBCode Plugin",
                author:"Moxiecode Systems AB",
                authorurl:"http://tinymce.moxiecode.com",
                infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/bbcode",
                version:tinymce.majorVersion+"."+tinymce.minorVersion
            }
        },
        _punbb_html2bbcode:function(a){
            a=tinymce.trim(a);
            function b(c,d){
                a=a.replace(c,d)
            }
            b(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi,"[url=$1]$2[/url]");
            b(/<font.*?color=\"(.*?)\".*?class=\"codeStyle\".*?>(.*?)<\/font>/gi,"[code][color=$1]$2[/color][/code]");
            b(/<font.*?color=\"(.*?)\".*?class=\"quoteStyle\".*?>(.*?)<\/font>/gi,"[quote][color=$1]$2[/color][/quote]");
            b(/<font.*?class=\"codeStyle\".*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[code][color=$1]$2[/color][/code]");
            b(/<font.*?class=\"quoteStyle\".*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[quote][color=$1]$2[/color][/quote]");
            b(/<span style=\"color: ?(.*?);\">(.*?)<\/span>/gi,"[color=$1]$2[/color]");
            b(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[color=$1]$2[/color]");
            b(/<span style=\"font-size:(.*?);\">(.*?)<\/span>/gi,"[size=$1]$2[/size]");
            b(/<font>(.*?)<\/font>/gi,"$1");
            b(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");
            b(/<span class=\"codeStyle\">(.*?)<\/span>/gi,"[code]$1[/code]");
            b(/<span class=\"quoteStyle\">(.*?)<\/span>/gi,"[quote]$1[/quote]");
            b(/<strong class=\"codeStyle\">(.*?)<\/strong>/gi,"[code][b]$1[/b][/code]");
            b(/<strong class=\"quoteStyle\">(.*?)<\/strong>/gi,"[quote][b]$1[/b][/quote]");
            b(/<em class=\"codeStyle\">(.*?)<\/em>/gi,"[code][i]$1[/i][/code]");
            b(/<em class=\"quoteStyle\">(.*?)<\/em>/gi,"[quote][i]$1[/i][/quote]");
            b(/<u class=\"codeStyle\">(.*?)<\/u>/gi,"[code][u]$1[/u][/code]");
            b(/<u class=\"quoteStyle\">(.*?)<\/u>/gi,"[quote][u]$1[/u][/quote]");
            b(/<\/(strong|b)>/gi,"[/b]");
            b(/<(strong|b)>/gi,"[b]");
            b(/<\/(em|i)>/gi,"[/i]");
            b(/<(em|i)>/gi,"[i]");
            b(/<\/u>/gi,"[/u]");
            b(/<span style=\"text-decoration: ?underline;\">(.*?)<\/span>/gi,"[u]$1[/u]");
            b(/<u>/gi,"[u]");
            b(/<blockquote[^>]*>/gi,"[quote]");
            b(/<\/blockquote>/gi,"[/quote]");
            b(/<br \/>/gi,"\n");
            b(/<br\/>/gi,"\n");
            b(/<br>/gi,"\n");
            b(/<p>/gi,"");
            b(/<\/p>/gi,"\n");
            b(/ |\u00a0/gi," ");
            b(/"/gi,'"');
            b(/</gi,"<");
            b(/>/gi,">");
            b(/&/gi,"&");
            return a
        },
        _punbb_bbcode2html:function(a){
            a=tinymce.trim(a);
            function b(c,d){
                a=a.replace(c,d)
            }
            b(/\n/gi,"<br />");
            b(/\[b\]/gi,"<strong>");
            b(/\[\/b\]/gi,"</strong>");
            b(/\[i\]/gi,"<em>");
            b(/\[\/i\]/gi,"</em>");
            b(/\[u\]/gi,"<u>");
            b(/\[\/u\]/gi,"</u>");
            b(/\[url=([^\]]+)\](.*?)\[\/url\]/gi,'<a href="../../../../Letters/jscripts/tiny_mce/plugins/bbcode/$1">$2</a>');
            b(/\[url\](.*?)\[\/url\]/gi,'<a href="../../../../Letters/jscripts/tiny_mce/plugins/bbcode/$1">$1</a>');
            b(/\[img\](.*?)\[\/img\]/gi,'<img src="../../../../Letters/jscripts/tiny_mce/plugins/bbcode/$1" />');
            b(/\[color=(.*?)\](.*?)\[\/color\]/gi,'<font color="$1">$2</font>');
            b(/\[code\](.*?)\[\/code\]/gi,'<span class="codeStyle">$1</span> ');
            b(/\[quote.*?\](.*?)\[\/quote\]/gi,'<span class="quoteStyle">$1</span> ');
            return a
        }
    });
    tinymce.PluginManager.add("bbcode",tinymce.plugins.BBCodePlugin)
})();