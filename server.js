const express = require('express');
const webpack = require('webpack');
const webpackDevMiddleware = require('webpack-dev-middleware');
const webpackHotMiddleware = require('webpack-hot-middleware');

const app = express();
const opn = require('opn')
const config = require('./webpack.config.js');
const compiler = webpack(config);
const proxyMiddleware = require('http-proxy-middleware');
const uri = 'http://localhost:3000';

var devMiddleware = webpackDevMiddleware(compiler, {
    publicPath: config.output.publicPath,
    quiet: true
})

var hotMiddleware = webpackHotMiddleware(compiler, {
    log: () => {}
})

// force page reload when html-webpack-plugin template changes
compiler.plugin('compilation', function (compilation) {
    compilation.plugin('html-webpack-plugin-after-emit', function (data, cb) {
        hotMiddleware.publish({
            action: 'reload'
        })
        cb()
    })
})


app.use(['/service'],proxyMiddleware({
    target: 'http://www.zhangdexian.top',
    changeOrigin: true,
}));

// Tell express to use the webpack-dev-middleware and use the webpack.config.js
// configuration file as a base.
app.use(devMiddleware);

app.use(hotMiddleware);

console.log('> Starting dev server...');
devMiddleware.waitUntilValid(() => {
    console.log('> Listening at ' + uri + '\n');
});

// Serve the files on port 3000.
app.listen(3000, function () {
    console.log('app listening on port 3000!\n');
    opn(uri)
});