const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');  // Cleans build folder

const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
    entry: {
        main: './assets/src/js/main.js',
    },
    output: {
        filename: '[name].min.js',
        path: path.resolve(__dirname, 'assets/build'),
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
        new CleanWebpackPlugin(), // Ensures a clean output directory
        new MiniCssExtractPlugin({
            filename: '[name].min.css',
        }),
    ],
    optimization: {
        minimize: isProduction,
        minimizer: [
            new TerserPlugin(),      // Minify JavaScript files
            new CssMinimizerPlugin(), // Minify CSS files
        ],
    },
    mode: isProduction ? 'production' : 'development',
    devtool: isProduction ? false : 'source-map', // Source maps for easier debugging
};
