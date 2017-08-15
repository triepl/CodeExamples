'use strict';
require('dotenv').config();
const bunyan = require('bunyan');

const log = {

    development: () => {
        return bunyan.createLogger({
            name: 'service-height-dev',
            level: 'debug'
        });
    },
    production: () => {
        return bunyan.createLogger({
            name: 'service-height-prod',
            level: 'info'
        });
    },
    test: () => {
        return bunyan.createLogger({
            name: 'service-height-test',
            level: 'fatal'
        });
    }
};

module.exports = {

    googleElevationApiKey: process.env.GOOGLE_ELEVATION_API_KEY,
    googleGeoApiKey: process.env.GOOGLE_GEO_API_KEY,

    log: (env) => {
        if(env) return log[env]();
        return log[process.env.NODE_ENV || 'development']()
    }
}