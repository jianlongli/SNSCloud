var waitting = 1;
var secondLeft = waitting;
var timer;
var sourceObj;
var number;
function getObject(objectId)//��ȡid�ĺ���
    {
        if(document.getElementById && document.getElementById(objectId)) {
        // W3C DOM
        return document.getElementById(objectId);
        } else if (document.all && document.all(objectId)) {
        // MSIE 4 DOM
        return document.all(objectId);
        } else if (document.layers && document.layers[objectId]) {
        // NN 4 DOM.. note: this won't find nested layers
        return document.layers[objectId];
        } else {
        return false;
        }
    }
function SetTimer()//������ʱ���ӳٵĺ���
    {
        for(j=1; j <10; j++){
            if (j == number){
                if(getObject("mm"+j)!=false){
                    getObject("mm"+ number).className = "menuhover";
                    getObject("mb"+ number).className = "";
                }
            }
            else{
                 if(getObject("mm"+j)!=false){
                    getObject("mm"+ j).className = "";
                    getObject("mb"+ j).className = "hide";
                }
            }
        }
    }
function CheckTime()//����ʱ���ӳٺ�
    {
        secondLeft--;
        if ( secondLeft == 0 )
        {
        clearInterval(timer);
        SetTimer();
        }
    }
function showM(thisobj,Num)//��������껬������,��ʱ���ӳ�
    {
        number = Num;
        sourceObj = thisobj;
        secondLeft = 1;
        timer = setTimeout('CheckTime()',100);
    }
function OnMouseLeft()//����������Ƴ�����,���ʱ�亯��
    {
        clearInterval(timer);
    }    
function mmenuURL()//������������������ʾ����
{
var thisURL = document.URL;
tmpUPage = thisURL.split( "/" );
thisUPage_s = tmpUPage[ tmpUPage.length-2 ];
thisUPage_s= thisUPage_s.toLowerCase();//Сд
	if(thisUPage_s=="test.hichina.com"||thisUPage_s=="www.net.cn"||thisUPage_s=="www.hichina.com")
	{
		getObject("mm1").className="menuhover"
		getObject("mb1").className = "";
	}
	else if(thisUPage_s=="domain")
	{
		getObject("mm2").className="menuhover"
		getObject("mb2").className = "";
	}
	else if(thisUPage_s=="hosting")
	{
		getObject("mm3").className="menuhover"
		getObject("mb3").className = "";
	}
	else if(thisUPage_s=="mail")
	{
		getObject("mm4").className="menuhover"
		getObject("mb4").className = "";
	}
	else if(thisUPage_s=="solutions"||thisUPage_s=="site"){
		getObject("mm5").className="menuhover"
		getObject("mb5").className = "";
	}
	else if(thisUPage_s=="promotion"){
		getObject("mm6").className="menuhover"
		getObject("mb6").className = "";
	}
	else if(thisUPage_s=="trade"||thisUPage_s=="phonetic"||thisUPage_s=="switchboard"||thisUPage_s=="note"){
		getObject("mm7").className="menuhover"
		getObject("mb7").className = "";
	}
	else if(thisUPage_s=="benefit"){
		getObject("mm8").className="menuhover"
		getObject("mb8").className = "";
	}
	else if(thisUPage_s=="userlogon"||thisUPage_s=="domain_service"||thisUPage_s=="hosting_service"||thisUPage_s=="mail_service"||thisUPage_s=="Payed"||thisUPage_s=="unPayed"||thisUPage_s=="Invoice"||thisUPage_s=="Finance"||thisUPage_s=="RegInfoModify"){
		getObject("mm9").className="menuhover"
		getObject("mb9").className = "";
	}
	else
	{
		getObject("mm1").className="";
		getObject("mb1").className = "";
	}
}
window.load=mmenuURL()