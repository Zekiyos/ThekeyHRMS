OFFSET=79372,DAY=1000*60*60*24
var EYear,EMonth,EDate,GC,browser,ver
function focusInputField(){
    browser=getBrowserName()
    if (browser=="N" && ver<5)
        alert ("This page is best viewed with Internet Explorer version 4 and later\n"+
            "and Netscape version 5 or later!")
    document.theForm.input.focus()
}
function getBrowserName(){
    ver=(navigator.appVersion).substring(0,1)
    return ((navigator.appName).indexOf("Explorer")==-1?"N":"E")
}

function isValid(dt){
    GC=new Date(dt)
    yearlen=(dt.substr(dt.lastIndexOf("/")+1)).length
    if (yearlen!=4)
        return false
    else return (GC.getFullYear()>=1753)
}
function getECDays(dt){
    UTCVal=Date.UTC(GC.getFullYear(),GC.getMonth(),GC.getDate())
    return OFFSET+(UTCVal/DAY)
}
function ECDate(dt){
    days=getECDays(dt)
    mark=0
    EYear=1745
    while (mark==0){
        if (EYear % 4 ==3){
            if (days>=366){
                days-=366
                EYear++
            }
            else mark=1
        }
        else{
            if (days>=365){
                days-=365
                EYear++
            }
            else mark=1
        }
    }
    if (days==0){
        EYear-=1
        EMonth=13
        EDate=5 + ((EYear % 4 ==3)?1:0)
    }
    else{
        EMonth = Math.ceil(days / 30)
        if (days % 30 ==0)
            EDate = 30
        else EDate=days % 30
    }
    return EMonth + "/"+ EDate + "/" + EYear
}
function getInWords(){
    months=["\u1218\u1235\u12a8\u1228\u121d","\u1325\u1245\u121d\u1275",
    "\u1285\u12f3\u122d","\u1273\u1285\u1223\u1225",
    "\u1325\u122d","\u12e8\u12ab\u1272\u1275",
    "\u1218\u130b\u1262\u1275","\u121a\u12eb\u12dd\u12eb",
    "\u130d\u1295\u1266\u1275","\u1230\u1294",
    "\u1210\u121d\u120c","\u1290\u1210\u1234",
    "\u1333\u1309\u121c"]
    return months[EMonth-1]+" "+EDate+", "+EYear
}
function getECDate(){
    if (isValid(document.theForm.input.value)){
        document.theForm.output.value=ECDate(document.theForm.input.value)
        document.theForm.output2.value=getInWords()
    }
    else{
        alert ("Gregorian date cannot be earlier than 1/1/1753!")
    }
}

function getKeyCode(e){
    document.theForm.output.value="";
    document.theForm.output2.value=""
    if (browser=="N")
        chr=e.which
    else chr=e.keyCode
    if (chr==13)
        getECDate();
    else if (chr!=8 && (chr<47 || chr>57)){
        return false
    }
}
