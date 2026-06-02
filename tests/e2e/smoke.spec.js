const { test, expect } = require('@playwright/test');

test('clinic landing renders core content and contact flow', async ({ page }) => {
  await page.goto('./');

  await expect(page.locator('#sobre-mim')).toBeVisible();
  await expect(page.locator('#psicoterapia')).toBeVisible();
  await expect(page.locator('#terapia-casal')).toBeVisible();
  await expect(page.locator('#agendar')).toBeVisible();
  await expect(page.locator('#form-orcamento')).toBeVisible();

  await page.locator('a[data-cta-id="agendar_primary"]').first().click();
  await expect(page.locator('#form-orcamento')).toBeInViewport();

  await page.locator('#cta-nome').fill('Paciente Teste');
  await page.locator('#cta-telefone').fill('(84) 99999-9999');
  await page.locator('#cta-email').fill('paciente@example.com');
  await page.getByRole('button', { name: /Próximo/i }).click();

  await expect(page.locator('#cta-mensagem')).toBeVisible();
  await page.locator('#cta-mensagem').fill('Gostaria de agendar um atendimento.');
  await expect(page.getByRole('button', { name: /Enviar solicitação/i })).toBeVisible();
});
