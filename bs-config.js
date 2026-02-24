const proxyUrl = process.env.BROWSERSYNC_PROXY || 'http://localhost';

module.exports = {
  proxy: proxyUrl,
  files: [
    '**/*.php',
    '**/*.css',
    '**/*.js'
  ],
  notify: false,
  open: false,
  ghostMode: false,
  reloadDelay: 120
};
