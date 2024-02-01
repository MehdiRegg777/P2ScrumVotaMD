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

            await this.driver.findElement(By.id('username')).sendKeys('PruebaTest');

            await this.driver.findElement(By.id('username')).sendKeys(Key.ENTER);
            console.log("Introducir dato en Usuario");

            const passwordLabel = await this.driver.findElement(By.css('label[for="password"]')).getText();
            assert(passwordLabel === "Contraseña:", "Texto de la etiqueta label incorrecto para el campo de contraseña");

            const passwordInput = await this.driver.findElement(By.id('password'));
await passwordInput.sendKeys('Tianle1234\n');





            console.log("TEST OK");
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
