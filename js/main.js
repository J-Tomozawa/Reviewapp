class MobileMenu {
  constructor() {
    this.DOM = {};
    this.DOM.btn = document.querySelector(".mobile-menu__btn");
    this.DOM.cover = document.querySelector(".mobile-menu__cover");
    this.DOM.container = document.querySelector("#container");
    this._addEvent();
  }
  _toggle() {
    this.DOM.container.classList.toggle("menu-open");
  }

  _addEvent() {
    this.DOM.btn.addEventListener('click', this._toggle.bind(this));
    this.DOM.cover.addEventListener('click', this._toggle.bind(this));
  }
}

new MobileMenu();

