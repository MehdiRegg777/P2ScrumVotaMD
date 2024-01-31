// carreguem les llibreries
const { BasePhpTest } = require("./BasePhpTest.js");
const { By, until } = require("selenium-webdriver");
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
            await username.sendKeys('PruebaTest\n');

            const passwordInput = await this.driver.findElement(By.id('password'));
            await passwordInput.sendKeys('Tianle1234\n');

            const confirmPasswordInput = await this.driver.findElement(By.id('confirm_password'));
            await confirmPasswordInput.sendKeys('Tianle1234\n');

            const emailInput = await this.driver.findElement(By.id('email'));
            await emailInput.sendKeys('tianleyin8888@gmail.com\n');

            const phoneInput = await this.driver.findElement(By.id('phone'));
            await phoneInput.sendKeys('666666666\n');

            const countryDropdown = await this.driver.findElement(By.id('country'));
            const optionToSelect = 'SPAIN'
            await countryDropdown.findElement(By.css(`option[value="${optionToSelect}"]`)).click();

            const cityInput = await driver.findElement(By.id('city'));
            await cityInput.sendKeys('Barcelona\n');

            const postalCodeInput = await driver.findElement(By.id('postal_code'));
            await postalCodeInput.sendKeys('08940\n');


            const registerButton = await driver.findElement(By.className('form-button'));
            await registerButton.click();
            await driver.sleep(2000);
            try {
                const successMessage = await driver.findElement(By.css('.mensaje-notificacion2'));
                console.log('Test exitoso. La página muestra un mensaje de éxito:', await successMessage.getText());
            } catch (error) {
                console.error('Error: La página no muestra un mensaje de éxito. Podría haber ocurrido un problema durante el registro.');
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
