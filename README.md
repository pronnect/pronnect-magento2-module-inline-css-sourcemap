[![Packagist Version](https://img.shields.io/packagist/v/pronnect/module-css-inline-sourcemap)](https://packagist.org/packages/pronnect/module-css-inline-sourcemap)

The `pronnect/module-inline-css-sourcemap` module enhances Magento 2 with the ability to generate CSS source maps for inline CSS. This enables developers to more easily debug CSS and identify formatting issues.

**Module Features:**

* Generation of CSS source maps for inline CSS in Magento 2.
* Simplified CSS debugging and identification of formatting problems.
* Increased browser compatibility and accessibility.
* Improved overall frontend development and maintenance.

**Development Installation:**

```bash
composer req --dev pronnect/module-inline-css-sourcemap
```

**Post-Installation:**

1. **Activate the module**
```bash
bin/magento module:enable Pronnect_CssInlineSourceMap
bin/magento setup:upgrade
```


2. **Clear the Magento 2 cache**.

**Post-Installation (Development Only):**
**Further Information:**

* For more information about the module, please visit the GitHub page: [https://github.com/pronnect/pronnect-magento2-module-inline-css-sourcemap](https://github.com/pronnect/pronnect-magento2-module-inline-css-sourcemap)

**Important:**

* This module is compatible with Magento 2 versions 2.3.x and 2.4.x.
* Back up your Magento 2 installation before installing the module.

**Thank you for using the `pronnect/module-inline-css-sourcemap` module!**

**Enabling the Module in Developer Mode:**

While the previous steps activate the module, in Magento 2 some developer-oriented settings might be disabled by default. To ensure all functionalities are available during development, consider these additional steps:

1. Navigate to **Stores** > **Configuration** > **Advanced** > **Developer**.
2. In the **CSS Settings** section, set **Use CSS Inline Source Map** Yes/No to enable/disable feature
3. Click the **Save Config** button.

This section is relevant mainly for development installations (using composer req --dev).

**Benefits of using CSS source maps:**

* **Improved Debugging:** CSS source maps allow you to map inline CSS styles back to their original source files, making it easier to identify and fix formatting issues.
* **Enhanced Browser Compatibility:** By generating source maps, you can ensure that your inline CSS is compatible with a wider range of browsers, including older versions.
* **Increased Accessibility:** CSS source maps can improve the accessibility of your website by providing screen readers with additional information about the structure of your CSS.
* **Better Development Workflow:** Source maps can streamline your development workflow by allowing you to make changes to your CSS and see the results immediately without having to refresh the page.

**Overall, the `pronnect/module-inline-css-sourcemap` module is a valuable tool for developers who want to improve the quality, compatibility, and accessibility of their Magento 2 websites.**
