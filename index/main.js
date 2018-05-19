import 'babel-polyfill';
import getData from '../config/fetch';
require('./style/style.css');

getNetVisitNum();
logLoin();



async function getNetVisitNum() {
    let totalLogin, totalIp; //网站访问总人数、Ip
    let url = '/index/getVisitorNumbers';
    try {
        const res = await getData(url);
        if (res.status) {
            totalLogin = res.data.total;
            totalIp = res.data.totalIp;
            document.getElementById('ip1').innerHTML = '<span>网站总访问量：'+ totalLogin +'</span>';
            document.getElementById('ip2').innerHTML = '<span>网站总ip访问量：'+ totalIp +'</span>';
            // $('.ip-data').eq(0).text('网站总访问量：' + totalLogin);
            // $('.ip-data').eq(1).text('网站总ip访问量：' + totalIp);
        }
    } catch (err) {
        console.log(err);
    }
}

async function logLoin() {
    let url = '/index/logIp';
    try {
        const res = await getData(url);
        if (res.status) {
            //alert('欢迎访问苍青浪个人网站');
            //console.log('登录成功！');
        }
    } catch (err) {
        console.log(err);
    }

}