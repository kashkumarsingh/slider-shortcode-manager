const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
    entry: {
        main: './assets/src/js/index.js',
    },
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, 'assets/build'),
        clean: true,
    },
    module: {
        rules: [
            // SCSS to CSS
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader',
                ],
            },
            // CSS from node_modules (e.g., Swiper)
            {
                test: /\.css$/,
                include: /node_modules/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                ],
            },
            // JavaScript
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
        ],
    },
    plugins: [
        ...(isProduction ? [new CleanWebpackPlugin()] : []),
        new MiniCssExtractPlugin({
            filename: '[name].min.css',
        }),
    ],
    optimization: {
        minimize: isProduction,
        minimizer: [
            new TerserPlugin(),
            new CssMinimizerPlugin(),
        ],
    },
    mode: isProduction ? 'production' : 'development',
    devtool: isProduction ? false : 'source-map',
};