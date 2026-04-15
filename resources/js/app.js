import './bootstrap';

const THEME_KEY = 'theme';
const LIGHT = 'light';
const DARK = 'dark';

function currentTheme() {
    // check local storage first
    return document.documentElement.getAttribute('data-theme') || LIGHT;
}

function setTheme(theme) {
    // set the theme on the root element and save it to local storage
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem(THEME_KEY, theme);
    syncThemeIcons(theme);
}

function syncThemeIcons(theme) {
    // show the light icon if the current theme is dark, and vice versa
    const showLightIcon = theme === DARK;

    // toggle the visibility of the icons based on the current theme
    document.querySelectorAll('[data-theme-icon-light]').forEach((icon) => {
        icon.classList.toggle('hidden', !showLightIcon);
    });

    // toggle the visibility of the icons based on the current theme
    document.querySelectorAll('[data-theme-icon-dark]').forEach((icon) => {
        icon.classList.toggle('hidden', showLightIcon);
    });
}

function initThemeSwitcher() {
    // set the initial theme based on local storage or default to light
    const initialTheme = currentTheme();
    // apply the initial theme to the document
    syncThemeIcons(initialTheme);

    // add click event listeners to all theme toggle buttons
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const nextTheme = currentTheme() === DARK ? LIGHT : DARK;
            setTheme(nextTheme);
        });
    });
}

document.addEventListener('DOMContentLoaded', initThemeSwitcher);
