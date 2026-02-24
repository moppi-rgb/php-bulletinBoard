const proxyUrl = process.env.BROWSERSYNC_PROXY || 'php-bulletinboard.test';

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
