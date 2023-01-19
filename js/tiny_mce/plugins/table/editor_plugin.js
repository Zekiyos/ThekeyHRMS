(function(c){
    var d=c.each;
    function b(f,g){
        var h=g.ownerDocument,e=h.createRange(),j;
        e.setStartBefore(g);
        e.setEnd(f.endContainer,f.endOffset);
        j=h.createElement("body");
        j.appendChild(e.cloneContents());
        return j.innerHTML.replace(/<(br|img|object|embed|input|textarea)[^>]*>/gi,"-").replace(/<[^>]+>/g,"").length==0
    }
    function a(H,G,K){
        var f,L,D,o;
        t();
        o=G.getParent(K.getStart(),"th,td");
        if(o){
            L=F(o);
            D=I();
            o=z(L.x,L.y)
        }
        function A(N,M){
            N=N.cloneNode(M);
            N.removeAttribute("id");
            return N
        }
        function t(){
            var M=0;
            f=[];
            d(["thead","tbody","tfoot"],function(N){
                var O=G.select("> "+N+" tr",H);
                d(O,function(P,Q){
                    Q+=M;
                    d(G.select("> td, > th",P),function(W,R){
                        var S,T,U,V;
                        if(f[Q]){
                            while(f[Q][R]){
                                R++
                            }
                        }
                        U=h(W,"rowspan");
                        V=h(W,"colspan");
                        for(T=Q;T<Q+U;T++){
                            if(!f[T]){
                                f[T]=[]
                            }
                            for(S=R;S<R+V;S++){
                                f[T][S]={
                                    part:N,
                                    real:T==Q&&S==R,
                                    elm:W,
                                    rowspan:U,
                                    colspan:V
                                }
                            }
                        }
                    })
                });
                M+=O.length
            })
        }
        function z(M,O){
            var N;
            N=f[O];
            if(N){
                return N[M]
            }
        }
        function h(N,M){
            return parseInt(N.getAttribute(M)||1)
        }
        function s(O,M,N){
            if(O){
                N=parseInt(N);
                if(N===1){
                    O.removeAttribute(M,1)
                }else{
                    O.setAttribute(M,N,1)
                }
            }
        }
        function j(M){
            return M&&(G.hasClass(M.elm,"mceSelected")||M==o)
        }
        function k(){
            var M=[];
            d(H.rows,function(N){
                d(N.cells,function(O){
                    if(G.hasClass(O,"mceSelected")||O==o.elm){
                        M.push(N);
                        return false
                    }
                })
            });
            return M
        }
        function r(){
            var M=G.createRng();
            M.setStartAfter(H);
            M.setEndAfter(H);
            K.setRng(M);
            G.remove(H)
        }
        function e(M){
            var N;
            c.walk(M,function(P){
                var O;
                if(P.nodeType==3){
                    d(G.getParents(P.parentNode,null,M).reverse(),function(Q){
                        Q=A(Q,false);
                        if(!N){
                            N=O=Q
                        }else{
                            if(O){
                                O.appendChild(Q)
                            }
                        }
                        O=Q
                    });
                    if(O){
                        O.innerHTML=c.isIE?"&nbsp;":'<br data-mce-bogus="1" />'
                    }
                    return false
                }
            },"childNodes");
            M=A(M,false);
            s(M,"rowSpan",1);
            s(M,"colSpan",1);
            if(N){
                M.appendChild(N)
            }else{
                if(!c.isIE){
                    M.innerHTML='<br data-mce-bogus="1" />'
                }
            }
            return M
        }
        function q(){
            var M=G.createRng();
            d(G.select("tr",H),function(N){
                if(N.cells.length==0){
                    G.remove(N)
                }
            });
            if(G.select("tr",H).length==0){
                M.setStartAfter(H);
                M.setEndAfter(H);
                K.setRng(M);
                G.remove(H);
                return
            }
            d(G.select("thead,tbody,tfoot",H),function(N){
                if(N.rows.length==0){
                    G.remove(N)
                }
            });
            t();
            row=f[Math.min(f.length-1,L.y)];
            if(row){
                K.select(row[Math.min(row.length-1,L.x)].elm,true);
                K.collapse(true)
            }
        }
        function u(S,Q,U,R){
            var P,N,M,O,T;
            P=f[Q][S].elm.parentNode;
            for(M=1;M<=U;M++){
                P=G.getNext(P,"tr");
                if(P){
                    for(N=S;N>=0;N--){
                        T=f[Q+M][N].elm;
                        if(T.parentNode==P){
                            for(O=1;O<=R;O++){
                                G.insertAfter(e(T),T)
                            }
                            break
                        }
                    }
                    if(N==-1){
                        for(O=1;O<=R;O++){
                            P.insertBefore(e(P.cells[0]),P.cells[0])
                        }
                    }
                }
            }
        }
        function C(){
            d(f,function(M,N){
                d(M,function(P,O){
                    var S,R,T,Q;
                    if(j(P)){
                        P=P.elm;
                        S=h(P,"colspan");
                        R=h(P,"rowspan");
                        if(S>1||R>1){
                            s(P,"rowSpan",1);
                            s(P,"colSpan",1);
                            for(Q=0;Q<S-1;Q++){
                                G.insertAfter(e(P),P)
                            }
                            u(O,N,R-1,S)
                        }
                    }
                })
            })
        }
        function p(V,S,Y){
            var P,O,X,W,U,R,T,M,V,N,Q;
            if(V){
                pos=F(V);
                P=pos.x;
                O=pos.y;
                X=P+(S-1);
                W=O+(Y-1)
            }else{
                P=L.x;
                O=L.y;
                X=D.x;
                W=D.y
            }
            T=z(P,O);
            M=z(X,W);
            if(T&&M&&T.part==M.part){
                C();
                t();
                T=z(P,O).elm;
                s(T,"colSpan",(X-P)+1);
                s(T,"rowSpan",(W-O)+1);
                for(R=O;R<=W;R++){
                    for(U=P;U<=X;U++){
                        if(!f[R]||!f[R][U]){
                            continue
                        }
                        V=f[R][U].elm;
                        if(V!=T){
                            N=c.grep(V.childNodes);
                            d(N,function(Z){
                                T.appendChild(Z)
                            });
                            if(N.length){
                                N=c.grep(T.childNodes);
                                Q=0;
                                d(N,function(Z){
                                    if(Z.nodeName=="BR"&&G.getAttrib(Z,"data-mce-bogus")&&Q++<N.length-1){
                                        T.removeChild(Z)
                                    }
                                })
                            }
                            G.remove(V)
                        }
                    }
                }
                q()
            }
        }
        function l(Q){
            var M,S,P,R,T,U,N,V,O;
            d(f,function(W,X){
                d(W,function(Z,Y){
                    if(j(Z)){
                        Z=Z.elm;
                        T=Z.parentNode;
                        U=A(T,false);
                        M=X;
                        if(Q){
                            return false
                        }
                    }
                });
                if(Q){
                    return !M
                }
            });
            for(R=0;R<f[0].length;R++){
                if(!f[M][R]){
                    continue
                }
                S=f[M][R].elm;
                if(S!=P){
                    if(!Q){
                        O=h(S,"rowspan");
                        if(O>1){
                            s(S,"rowSpan",O+1);
                            continue
                        }
                    }else{
                        if(M>0&&f[M-1][R]){
                            V=f[M-1][R].elm;
                            O=h(V,"rowSpan");
                            if(O>1){
                                s(V,"rowSpan",O+1);
                                continue
                            }
                        }
                    }
                    N=e(S);
                    s(N,"colSpan",S.colSpan);
                    U.appendChild(N);
                    P=S
                }
            }
            if(U.hasChildNodes()){
                if(!Q){
                    G.insertAfter(U,T)
                }else{
                    T.parentNode.insertBefore(U,T)
                }
            }
        }
        function g(N){
            var O,M;
            d(f,function(P,Q){
                d(P,function(S,R){
                    if(j(S)){
                        O=R;
                        if(N){
                            return false
                        }
                    }
                });
                if(N){
                    return !O
                }
            });
            d(f,function(S,T){
                var P,Q,R;
                if(!S[O]){
                    return
                }
                P=S[O].elm;
                if(P!=M){
                    R=h(P,"colspan");
                    Q=h(P,"rowspan");
                    if(R==1){
                        if(!N){
                            G.insertAfter(e(P),P);
                            u(O,T,Q-1,R)
                        }else{
                            P.parentNode.insertBefore(e(P),P);
                            u(O,T,Q-1,R)
                        }
                    }else{
                        s(P,"colSpan",P.colSpan+1)
                    }
                    M=P
                }
            })
        }
        function n(){
            var M=[];
            d(f,function(N,O){
                d(N,function(Q,P){
                    if(j(Q)&&c.inArray(M,P)===-1){
                        d(f,function(T){
                            var R=T[P].elm,S;
                            S=h(R,"colSpan");
                            if(S>1){
                                s(R,"colSpan",S-1)
                            }else{
                                G.remove(R)
                            }
                        });
                        M.push(P)
                    }
                })
            });
            q()
        }
        function m(){
            var N;
            function M(Q){
                var P,R,O;
                P=G.getNext(Q,"tr");
                d(Q.cells,function(S){
                    var T=h(S,"rowSpan");
                    if(T>1){
                        s(S,"rowSpan",T-1);
                        R=F(S);
                        u(R.x,R.y,1,1)
                    }
                });
                R=F(Q.cells[0]);
                d(f[R.y],function(S){
                    var T;
                    S=S.elm;
                    if(S!=O){
                        T=h(S,"rowSpan");
                        if(T<=1){
                            G.remove(S)
                        }else{
                            s(S,"rowSpan",T-1)
                        }
                        O=S
                    }
                })
            }
            N=k();
            d(N.reverse(),function(O){
                M(O)
            });
            q()
        }
        function E(){
            var M=k();
            G.remove(M);
            q();
            return M
        }
        function J(){
            var M=k();
            d(M,function(O,N){
                M[N]=A(O,true)
            });
            return M
        }
        function B(O,N){
            var P=k(),M=P[N?0:P.length-1],Q=M.cells.length;
            d(f,function(S){
                var R;
                Q=0;
                d(S,function(U,T){
                    if(U.real){
                        Q+=U.colspan
                    }
                    if(U.elm.parentNode==M){
                        R=1
                    }
                });
                if(R){
                    return false
                }
            });
            if(!N){
                O.reverse()
            }
            d(O,function(T){
                var S=T.cells.length,R;
                for(i=0;i<S;i++){
                    R=T.cells[i];
                    s(R,"colSpan",1);
                    s(R,"rowSpan",1)
                }
                for(i=S;i<Q;i++){
                    T.appendChild(e(T.cells[S-1]))
                }
                for(i=Q;i<S;i++){
                    G.remove(T.cells[i])
                }
                if(N){
                    M.parentNode.insertBefore(T,M)
                }else{
                    G.insertAfter(T,M)
                }
            })
        }
        function F(M){
            var N;
            d(f,function(O,P){
                d(O,function(R,Q){
                    if(R.elm==M){
                        N={
                            x:Q,
                            y:P
                        };
                
                        return false
                    }
                });
                return !N
            });
            return N
        }
        function w(M){
            L=F(M)
        }
        function I(){
            var O,N,M;
            N=M=0;
            d(f,function(P,Q){
                d(P,function(S,R){
                    var U,T;
                    if(j(S)){
                        S=f[Q][R];
                        if(R>N){
                            N=R
                        }
                        if(Q>M){
                            M=Q
                        }
                        if(S.real){
                            U=S.colspan-1;
                            T=S.rowspan-1;
                            if(U){
                                if(R+U>N){
                                    N=R+U
                                }
                            }
                            if(T){
                                if(Q+T>M){
                                    M=Q+T
                                }
                            }
                        }
                    }
                })
            });
            return{
                x:N,
                y:M
            }
        }
        function v(S){
            var P,O,U,T,N,M,Q,R;
            D=F(S);
            if(L&&D){
                P=Math.min(L.x,D.x);
                O=Math.min(L.y,D.y);
                U=Math.max(L.x,D.x);
                T=Math.max(L.y,D.y);
                N=U;
                M=T;
                for(y=O;y<=M;y++){
                    S=f[y][P];
                    if(!S.real){
                        if(P-(S.colspan-1)<P){
                            P-=S.colspan-1
                        }
                    }
                }
                for(x=P;x<=N;x++){
                    S=f[O][x];
                    if(!S.real){
                        if(O-(S.rowspan-1)<O){
                            O-=S.rowspan-1
                        }
                    }
                }
                for(y=O;y<=T;y++){
                    for(x=P;x<=U;x++){
                        S=f[y][x];
                        if(S.real){
                            Q=S.colspan-1;
                            R=S.rowspan-1;
                            if(Q){
                                if(x+Q>N){
                                    N=x+Q
                                }
                            }
                            if(R){
                                if(y+R>M){
                                    M=y+R
                                }
                            }
                        }
                    }
                }
                G.removeClass(G.select("td.mceSelected,th.mceSelected"),"mceSelected");
                for(y=O;y<=M;y++){
                    for(x=P;x<=N;x++){
                        if(f[y][x]){
                            G.addClass(f[y][x].elm,"mceSelected")
                        }
                    }
                }
            }
        }
        c.extend(this,{
            deleteTable:r,
            split:C,
            merge:p,
            insertRow:l,
            insertCol:g,
            deleteCols:n,
            deleteRows:m,
            cutRows:E,
            copyRows:J,
            pasteRows:B,
            getPos:F,
            setStartCell:w,
            setEndCell:v
        })
    }
    c.create("tinymce.plugins.TablePlugin",{
        init:function(f,g){
            var e,k;
            function j(n){
                var m=f.selection,l=f.dom.getParent(n||m.getNode(),"table");
                if(l){
                    return new a(l,f.dom,m)
                }
            }
            function h(){
                f.getBody().style.webkitUserSelect="";
                f.dom.removeClass(f.dom.select("td.mceSelected,th.mceSelected"),"mceSelected")
            }
            d([["table","table.desc","mceInsertTable",true],["delete_table","table.del","mceTableDelete"],["delete_col","table.delete_col_desc","mceTableDeleteCol"],["delete_row","table.delete_row_desc","mceTableDeleteRow"],["col_after","table.col_after_desc","mceTableInsertColAfter"],["col_before","table.col_before_desc","mceTableInsertColBefore"],["row_after","table.row_after_desc","mceTableInsertRowAfter"],["row_before","table.row_before_desc","mceTableInsertRowBefore"],["row_props","table.row_desc","mceTableRowProps",true],["cell_props","table.cell_desc","mceTableCellProps",true],["split_cells","table.split_cells_desc","mceTableSplitCells",true],["merge_cells","table.merge_cells_desc","mceTableMergeCells",true]],function(l){
                f.addButton(l[0],{
                    title:l[1],
                    cmd:l[2],
                    ui:l[3]
                })
            });
            if(!c.isIE){
                f.onClick.add(function(l,m){
                    m=m.target;
                    if(m.nodeName==="TABLE"){
                        l.selection.select(m);
                        l.nodeChanged()
                    }
                })
            }
            f.onPreProcess.add(function(m,n){
                var l,o,p,r=m.dom,q;
                l=r.select("table",n.node);
                o=l.length;
                while(o--){
                    p=l[o];
                    r.setAttrib(p,"data-mce-style","");
                    if((q=r.getAttrib(p,"width"))){
                        r.setStyle(p,"width",q);
                        r.setAttrib(p,"width","")
                    }
                    if((q=r.getAttrib(p,"height"))){
                        r.setStyle(p,"height",q);
                        r.setAttrib(p,"height","")
                    }
                }
            });
            f.onNodeChange.add(function(m,l,q){
                var o;
                q=m.selection.getStart();
                o=m.dom.getParent(q,"td,th,caption");
                l.setActive("table",q.nodeName==="TABLE"||!!o);
                if(o&&o.nodeName==="CAPTION"){
                    o=0
                }
                l.setDisabled("delete_table",!o);
                l.setDisabled("delete_col",!o);
                l.setDisabled("delete_table",!o);
                l.setDisabled("delete_row",!o);
                l.setDisabled("col_after",!o);
                l.setDisabled("col_before",!o);
                l.setDisabled("row_after",!o);
                l.setDisabled("row_before",!o);
                l.setDisabled("row_props",!o);
                l.setDisabled("cell_props",!o);
                l.setDisabled("split_cells",!o);
                l.setDisabled("merge_cells",!o)
            });
            f.onInit.add(function(m){
                var l,p,q=m.dom,n;
                e=m.windowManager;
                m.onMouseDown.add(function(r,s){
                    if(s.button!=2){
                        h();
                        p=q.getParent(s.target,"td,th");
                        l=q.getParent(p,"table")
                    }
                });
                q.bind(m.getDoc(),"mouseover",function(v){
                    var t,s,u=v.target;
                    if(p&&(n||u!=p)&&(u.nodeName=="TD"||u.nodeName=="TH")){
                        s=q.getParent(u,"table");
                        if(s==l){
                            if(!n){
                                n=j(s);
                                n.setStartCell(p);
                                m.getBody().style.webkitUserSelect="none"
                            }
                            n.setEndCell(u)
                        }
                        t=m.selection.getSel();
                        try{
                            if(t.removeAllRanges){
                                t.removeAllRanges()
                            }else{
                                t.empty()
                            }
                        }catch(r){}
                        v.preventDefault()
                    }
                });
                m.onMouseUp.add(function(A,B){
                    var s,u=A.selection,C,D=u.getSel(),r,v,t,z;
                    if(p){
                        if(n){
                            A.getBody().style.webkitUserSelect=""
                        }
                        function w(E,G){
                            var F=new c.dom.TreeWalker(E,E);
                            do{
                                if(E.nodeType==3&&c.trim(E.nodeValue).length!=0){
                                    if(G){
                                        s.setStart(E,0)
                                    }else{
                                        s.setEnd(E,E.nodeValue.length)
                                    }
                                    return
                                }
                                if(E.nodeName=="BR"){
                                    if(G){
                                        s.setStartBefore(E)
                                    }else{
                                        s.setEndBefore(E)
                                    }
                                    return
                                }
                            }while(E=(G?F.next():F.prev()))
                        }
                        C=q.select("td.mceSelected,th.mceSelected");
                        if(C.length>0){
                            s=q.createRng();
                            v=C[0];
                            z=C[C.length-1];
                            w(v,1);
                            r=new c.dom.TreeWalker(v,q.getParent(C[0],"table"));
                            do{
                                if(v.nodeName=="TD"||v.nodeName=="TH"){
                                    if(!q.hasClass(v,"mceSelected")){
                                        break
                                    }
                                    t=v
                                }
                            }while(v=r.next());
                            w(t);
                            u.setRng(s)
                        }
                        A.nodeChanged();
                        p=n=l=null
                    }
                });
                m.onKeyUp.add(function(r,s){
                    h()
                });
                if(m&&m.plugins.contextmenu){
                    m.plugins.contextmenu.onContextMenu.add(function(t,r,v){
                        var w,u=m.selection,s=u.getNode()||m.getBody();
                        if(m.dom.getParent(v,"td")||m.dom.getParent(v,"th")||m.dom.select("td.mceSelected,th.mceSelected").length){
                            r.removeAll();
                            if(s.nodeName=="A"&&!m.dom.getAttrib(s,"name")){
                                r.add({
                                    title:"advanced.link_desc",
                                    icon:"link",
                                    cmd:m.plugins.advlink?"mceAdvLink":"mceLink",
                                    ui:true
                                });
                                r.add({
                                    title:"advanced.unlink_desc",
                                    icon:"unlink",
                                    cmd:"UnLink"
                                });
                                r.addSeparator()
                            }
                            if(s.nodeName=="IMG"&&s.className.indexOf("mceItem")==-1){
                                r.add({
                                    title:"advanced.image_desc",
                                    icon:"image",
                                    cmd:m.plugins.advimage?"mceAdvImage":"mceImage",
                                    ui:true
                                });
                                r.addSeparator()
                            }
                            r.add({
                                title:"table.desc",
                                icon:"table",
                                cmd:"mceInsertTable",
                                value:{
                                    action:"insert"
                                }
                            });
                            r.add({
                                title:"table.props_desc",
                                icon:"table_props",
                                cmd:"mceInsertTable"
                            });
                            r.add({
                                title:"table.del",
                                icon:"delete_table",
                                cmd:"mceTableDelete"
                            });
                            r.addSeparator();
                            w=r.addMenu({
                                title:"table.cell"
                            });
                            w.add({
                                title:"table.cell_desc",
                                icon:"cell_props",
                                cmd:"mceTableCellProps"
                            });
                            w.add({
                                title:"table.split_cells_desc",
                                icon:"split_cells",
                                cmd:"mceTableSplitCells"
                            });
                            w.add({
                                title:"table.merge_cells_desc",
                                icon:"merge_cells",
                                cmd:"mceTableMergeCells"
                            });
                            w=r.addMenu({
                                title:"table.row"
                            });
                            w.add({
                                title:"table.row_desc",
                                icon:"row_props",
                                cmd:"mceTableRowProps"
                            });
                            w.add({
                                title:"table.row_before_desc",
                                icon:"row_before",
                                cmd:"mceTableInsertRowBefore"
                            });
                            w.add({
                                title:"table.row_after_desc",
                                icon:"row_after",
                                cmd:"mceTableInsertRowAfter"
                            });
                            w.add({
                                title:"table.delete_row_desc",
                                icon:"delete_row",
                                cmd:"mceTableDeleteRow"
                            });
                            w.addSeparator();
                            w.add({
                                title:"table.cut_row_desc",
                                icon:"cut",
                                cmd:"mceTableCutRow"
                            });
                            w.add({
                                title:"table.copy_row_desc",
                                icon:"copy",
                                cmd:"mceTableCopyRow"
                            });
                            w.add({
                                title:"table.paste_row_before_desc",
                                icon:"paste",
                                cmd:"mceTablePasteRowBefore"
                            }).setDisabled(!k);
                            w.add({
                                title:"table.paste_row_after_desc",
                                icon:"paste",
                                cmd:"mceTablePasteRowAfter"
                            }).setDisabled(!k);
                            w=r.addMenu({
                                title:"table.col"
                            });
                            w.add({
                                title:"table.col_before_desc",
                                icon:"col_before",
                                cmd:"mceTableInsertColBefore"
                            });
                            w.add({
                                title:"table.col_after_desc",
                                icon:"col_after",
                                cmd:"mceTableInsertColAfter"
                            });
                            w.add({
                                title:"table.delete_col_desc",
                                icon:"delete_col",
                                cmd:"mceTableDeleteCol"
                            })
                        }else{
                            r.add({
                                title:"table.desc",
                                icon:"table",
                                cmd:"mceInsertTable"
                            })
                        }
                    })
                }
                if(!c.isIE){
                    function o(){
                        var r;
                        for(r=m.getBody().lastChild;r&&r.nodeType==3&&!r.nodeValue.length;r=r.previousSibling){}
                        if(r&&r.nodeName=="TABLE"){
                            m.dom.add(m.getBody(),"p",null,'<br mce_bogus="1" />')
                        }
                    }
                    if(c.isGecko){
                        m.onKeyDown.add(function(s,u){
                            var r,t,v=s.dom;
                            if(u.keyCode==37||u.keyCode==38){
                                r=s.selection.getRng();
                                t=v.getParent(r.startContainer,"table");
                                if(t&&s.getBody().firstChild==t){
                                    if(b(r,t)){
                                        r=v.createRng();
                                        r.setStartBefore(t);
                                        r.setEndBefore(t);
                                        s.selection.setRng(r);
                                        u.preventDefault()
                                    }
                                }
                            }
                        })
                    }
                    m.onKeyUp.add(o);
                    m.onSetContent.add(o);
                    m.onVisualAid.add(o);
                    m.onPreProcess.add(function(r,t){
                        var s=t.node.lastChild;
                        if(s&&s.childNodes.length==1&&s.firstChild.nodeName=="BR"){
                            r.dom.remove(s)
                        }
                    });
                    o()
                }
            });
            d({
                mceTableSplitCells:function(l){
                    l.split()
                },
                mceTableMergeCells:function(m){
                    var n,o,l;
                    l=f.dom.getParent(f.selection.getNode(),"th,td");
                    if(l){
                        n=l.rowSpan;
                        o=l.colSpan
                    }
                    if(!f.dom.select("td.mceSelected,th.mceSelected").length){
                        e.open({
                            url:g+"/merge_cells.htm",
                            width:240+parseInt(f.getLang("table.merge_cells_delta_width",0)),
                            height:110+parseInt(f.getLang("table.merge_cells_delta_height",0)),
                            inline:1
                        },{
                            rows:n,
                            cols:o,
                            onaction:function(p){
                                m.merge(l,p.cols,p.rows)
                            },
                            plugin_url:g
                        })
                    }else{
                        m.merge()
                    }
                },
                mceTableInsertRowBefore:function(l){
                    l.insertRow(true)
                },
                mceTableInsertRowAfter:function(l){
                    l.insertRow()
                },
                mceTableInsertColBefore:function(l){
                    l.insertCol(true)
                },
                mceTableInsertColAfter:function(l){
                    l.insertCol()
                },
                mceTableDeleteCol:function(l){
                    l.deleteCols()
                },
                mceTableDeleteRow:function(l){
                    l.deleteRows()
                },
                mceTableCutRow:function(l){
                    k=l.cutRows()
                },
                mceTableCopyRow:function(l){
                    k=l.copyRows()
                },
                mceTablePasteRowBefore:function(l){
                    l.pasteRows(k,true)
                },
                mceTablePasteRowAfter:function(l){
                    l.pasteRows(k)
                },
                mceTableDelete:function(l){
                    l.deleteTable()
                }
            },function(m,l){
                f.addCommand(l,function(){
                    var n=j();
                    if(n){
                        m(n);
                        f.execCommand("mceRepaint");
                        h()
                    }
                })
            });
            d({
                mceInsertTable:function(l){
                    e.open({
                        url:g+"/table.htm",
                        width:400+parseInt(f.getLang("table.table_delta_width",0)),
                        height:320+parseInt(f.getLang("table.table_delta_height",0)),
                        inline:1
                    },{
                        plugin_url:g,
                        action:l?l.action:0
                    })
                },
                mceTableRowProps:function(){
                    e.open({
                        url:g+"/row.htm",
                        width:400+parseInt(f.getLang("table.rowprops_delta_width",0)),
                        height:295+parseInt(f.getLang("table.rowprops_delta_height",0)),
                        inline:1
                    },{
                        plugin_url:g
                    })
                },
                mceTableCellProps:function(){
                    e.open({
                        url:g+"/cell.htm",
                        width:400+parseInt(f.getLang("table.cellprops_delta_width",0)),
                        height:295+parseInt(f.getLang("table.cellprops_delta_height",0)),
                        inline:1
                    },{
                        plugin_url:g
                    })
                }
            },function(m,l){
                f.addCommand(l,function(n,o){
                    m(o)
                })
            })
        }
    });
    c.PluginManager.add("table",c.plugins.TablePlugin)
})(tinymce);