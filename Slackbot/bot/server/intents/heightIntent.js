'use strict';

const request = require('superagent');

module.exports.process = function process(intentData, registry, log, cb) {
    
    if(intentData.intent[0].value !== 'height') 
        return cb(new Error('Expected height intent but got ' + intentData.intent[0].value));

    const location = intentData.location[0].value.replace(/,.?triepl\-bot/i, '');



    const service = registry.get('height');
    if(!service) return cb(false, 'No service available');

    request.get(`http://${service.ip}:${service.port}/service/${location}`)
    .then((res) => {
        if(!res.body.result) return cb('Error with height service');
        return cb(null, `${location} is on a height of  ${res.body.result}m`) ;
    });

}