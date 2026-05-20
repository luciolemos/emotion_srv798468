const { chromium } = require('@playwright/test');
(async () => {
  const sizes = [
    { w: 320, h: 900, n: '320' },
    { w: 375, h: 900, n: '375' },
    { w: 768, h: 1024, n: '768' },
    { w: 1024, h: 1200, n: '1024' },
    { w: 1440, h: 1400, n: '1440' },
  ];
  const browser = await chromium.launch({ headless: true });
  for (const s of sizes) {
    const page = await browser.newPage({ viewport: { width: s.w, height: s.h } });
    await page.goto('https://srv798468.hstgr.cloud/emotion/', { waitUntil: 'networkidle' });
    await page.screenshot({ path: `tmp/qa/emotion-${s.n}.png`, fullPage: true });
    await page.close();
  }
  await browser.close();
})();
