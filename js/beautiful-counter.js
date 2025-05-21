/* Beautiful jQuery Countdown Timer Plugin*/
!function(e){e.fn.countdown=function(t,s){thisEl=e(this);var n={date:null,format:null};function i(){eventDate=Date.parse(n.date)/1e3,currentDate=Math.floor(e.now()/1e3),eventDate<=currentDate&&(s.call(this),clearInterval(interval)),seconds=eventDate-currentDate,days=Math.floor(seconds/86400),seconds-=60*days*60*24,hours=Math.floor(seconds/3600),seconds-=60*hours*60,minutes=Math.floor(seconds/60),seconds-=60*minutes,1==days?thisEl.find(".timeRefDays").text("day"):thisEl.find(".timeRefDays").text("days"),1==hours?thisEl.find(".timeRefHours").text("hour"):thisEl.find(".timeRefHours").text("hours"),1==minutes?thisEl.find(".timeRefMinutes").text("minute"):thisEl.find(".timeRefMinutes").text("minutes"),1==seconds?thisEl.find(".timeRefSeconds").text("second"):thisEl.find(".timeRefSeconds").text("seconds"),"on"==n.format&&(days=String(days).length>=2?days:"0"+days,hours=String(hours).length>=2?hours:"0"+hours,minutes=String(minutes).length>=2?minutes:"0"+minutes,seconds=String(seconds).length>=2?seconds:"0"+seconds),isNaN(eventDate)?(alert("Invalid date. Here's an example: 12 Tuesday 2012 17:30:00"),clearInterval(interval)):(thisEl.find(".days").text(days),thisEl.find(".hours").text(hours),thisEl.find(".minutes").text(minutes),thisEl.find(".seconds").text(seconds))}t&&e.extend(n,t),i(),interval=setInterval(i,1e3)}}(jQuery);
/* CountDown Clock Minimal Countdown */
!function(t){t.fn.countdown=function(e,n){function o(){var t=new Date(r.date),e=s(),o=t-e;if(0>o)return clearInterval(d),void(n&&"function"==typeof n&&n());var a=1e3,f=60*a,u=60*f,l=24*u,c=Math.floor(o/l),h=Math.floor(o%l/u),x=Math.floor(o%u/f),g=Math.floor(o%f/a),y=1===c?r.day:r.days,m=1===h?r.hour:r.hours,v=1===x?r.minute:r.minutes,D=1===g?r.second:r.seconds;c=String(c).length>=2?c:"0"+c,h=String(h).length>=2?h:"0"+h,x=String(x).length>=2?x:"0"+x,g=String(g).length>=2?g:"0"+g,i.find(".days").text(c),i.find(".hours").text(h),i.find(".minutes").text(x),i.find(".seconds").text(g),i.find(".days_text").text(y),i.find(".hours_text").text(m),i.find(".minutes_text").text(v),i.find(".seconds_text").text(D)}var r=t.extend({date:null,offset:null,day:"Day",days:"Days",hour:"Hour",hours:"Hours",minute:"Minute",minutes:"Minutes",second:"Second",seconds:"Seconds"},e);r.date||t.error("Date is not defined."),Date.parse(r.date)||t.error("Incorrect date format, it should look like this, 12/24/2012 12:00:00.");var i=this,s=function(){var t=new Date,e=t.getTime()+6e4*t.getTimezoneOffset(),n=new Date(e+36e5*r.offset);return n},d=setInterval(o,1e3)}}(jQuery);
/*jQuery Plugin To Create A Countdown Timer In Milliseconds - yuukCountdown.js */
!function(t,e,n){t.fn.yuukCountDown=function(e){var n={starttime:"",endtime:"",startCallBack:t.noop,notStartCallBack:t.noop,endCallBack:t.noop},a=t.extend(n,e);return this.each(function(e,n){({timer:null,countDown:function(){var t=Math.round((new Date).getTime()/1e3),e=Math.round(new Date(a.starttime)/1e3);endTime=Math.round(new Date(a.endtime)/1e3);var n=endTime-t;return{endLeftTime:n,startLeftTime:e-t,day:parseInt(n/60/60/24),hour:parseInt(n/60/60%24),minute:parseInt(n/60%60),second:parseInt(n%60),ms:parseInt((new Date(a.endtime)-(new Date).getTime())%1e3)}},setHtml:function(e){var i=this,l=e.endLeftTime,s=e.startLeftTime,r=i.fillZero(e.day),o=i.fillZero(e.hour),c=i.fillZero(e.minute),m=i.fillZero(e.second),u=i.fillZero(e.ms.toString().substr(0,2));s>0?a.notStartCallBack&&a.notStartCallBack(e):(l>0&&(t(n).html(['<li class="item"><i class="day">'+r+"</i><span>days</span></li>",'<li class="blank">:</li>','<li class="item"><i class="hour">'+o+"</i><span>hours</span></li>",'<li class="blank">:</li>','<li class="item"><i class="minute">'+c+"</i><span>minutes</span></li>",'<li class="blank">:</li>','<li class="item"><i class="second">'+m+"</i><span>seconds</span></li>",'<li class="blank">:</li>','<li class="item"><i class="ms">'+u+"</i><span>milliseconds</span></li>"].join(" ")),a.startCallBack&&a.startCallBack(e)),l<=0&&(a.endCallBack&&a.endCallBack(e),clearInterval(i.timer)))},fillZero:function(t){return t<10&&(t="0"+t),t},init:function(){var t=this;if(new Date(a.endtime)<=new Date(a.starttime))throw new Error("倒计时的开始时间不能大于结束时间~");this.timer=setInterval(function(){t.setHtml(t.countDown())},10)}}).init()})}}(jQuery,window);
/* This Custom Script For page-coming-soon4.html*/
$(function(){
	$('#minimal_countdown').countdown({
		date: '12/24/2020 23:59:59',
		offset: -8,
		day: 'Day',
		days: 'Days'
	}, function () {
		alert('Done!');
	});
});
/* This Custom Script For page-coming-soon5.html*/
$(document).ready(function(){
	$("#beautiful_countdown").countdown({
		date: "17 august 2020 12:00:00",
		format: "on"
	},	
	function() {
		// callback function
	});
});
/* This Custom Script For page-coming-soon3.html*/
$(function(){
    $('#js-countDown').yuukCountDown({
        starttime: '2018/01/05 00:00:00',
        endtime: '2020/01/23 10:59:59',
        notStartCallBack: function(time){
            console.log("Ready");
        },
        startCallBack: function(time){
            console.log("Running");
        },
        endCallBack: function(time){
            console.log("Complete");
        }
    });
});