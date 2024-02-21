// carreguem les llibreries
const { BasePhpTest } = require("./BasePhpTest.js");
const { By, until, Key } = require("selenium-webdriver");
const { Select } = require('selenium-webdriver/lib/select');
const assert = require('assert');

class MyTest extends BasePhpTest {
    async test() {
        try {
            await this.driver.get("http://localhost:8000/register.php");

            await this.driver.wait(until.elementLocated(By.tagName("h1")), 5000);

            const titleText = await this.driver.findElement(By.tagName("h1")).getText();

            assert.strictEqual(titleText, "Registrar Usuario", "Título H1 de la página incorrecto");
            console.log("Título Correcto");

            const labelText = await this.driver.findElement(By.css('label[for="username"].user-label')).getText();

            assert.strictEqual(labelText, "Usuario:", "Texto de la etiqueta label incorrecto");
            console.log("Label Correcta");

            const username = await this.driver.findElement(By.id('username'));
            await username.sendKeys('PruebaTest');
            await username.sendKeys(Key.ENTER);

            const passwordInput = await this.driver.findElement(By.css('.password-input'));
            await passwordInput.sendKeys('TianleYin1234');
            await passwordInput.sendKeys(Key.ENTER);  

            const confirmPasswordInput = await this.driver.findElement(By.id('confirm_password'));
            await confirmPasswordInput.sendKeys('TianleYin1234');
            await confirmPasswordInput.sendKeys(Key.ENTER);

            const emailInput = await this.driver.findElement(By.css('.email-input'));
            await emailInput.sendKeys('tianleyin8888@gmail.com');
            await emailInput.sendKeys(Key.ENTER);

            const phoneInput = await this.driver.findElement(By.id('phone'));
            await phoneInput.sendKeys('666666666');
            await phoneInput.sendKeys(Key.ENTER);

            const mailParagraph = await this.driver.wait(until.elementLocated(By.css('p.mail')), 5000);
            // Haz clic en el elemento <p class="mail"> para alejarlo
            await mailParagraph.click();

            const countryDropdown = await this.driver.wait(until.elementLocated(By.id('country')), 5000);
            await countryDropdown.click();
            const spainOption = await this.driver.wait(until.elementLocated(By.css('option[value="SPAIN"]')), 5000);
            await spainOption.click();
            await this.driver.actions().sendKeys(Key.ENTER).perform();
            await countryDropdown.sendKeys(Key.ENTER);

            const cityInput = await this.driver.wait(until.elementLocated(By.css('.city-input')), 5000);
            await cityInput.sendKeys('Barcelona');
            await cityInput.sendKeys(Key.ENTER);

            const postalCodeInput = await this.driver.findElement(By.id('postal_code'));
            await postalCodeInput.sendKeys('08940');
            await postalCodeInput.sendKeys(Key.ENTER);

            const authorsDiv = await this.driver.wait(until.elementLocated(By.css('div.authors')), 5000);
            // Haz clic en el elemento <div class="authors"> para alejarlo
            await authorsDiv.click();

            const registerButton = await this.driver.findElement(By.className('form-button'));
            await registerButton.click();
            await this.driver.sleep(2000);
            try {
                const successMessage = await this.driver.findElement(By.css('.mensaje-notificacion2'));
                console.log('Test exitoso. La página muestra un mensaje de éxito:', await successMessage.getText());
            } catch (error) {
                console.error('Error: La página no muestra un mensaje de éxito. Podría haber ocurrido un problema durante el registro.');
                console.log(error);
            }


        } catch (error) {
            console.error("ERROR:", error.message);
        } finally {
            // Cerrar el navegador al finalizar la prueba
            await this.driver.quit();
        }
    }
}

// Ejecutar el test
(async function test_example() {
    const test = new MyTest();
    await test.run();
    console.log("END");
})();
