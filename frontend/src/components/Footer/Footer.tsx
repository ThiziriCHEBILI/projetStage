import type { JSX } from "react";
import { Link } from "react-router";
import logo from "../../assets/logo_NOVA.png";
import "./Footer.scss";

export function Footer(): JSX.Element {
  return (
    <footer className="footer">
      <div className="footer__inner">
        <div className="footer__logotexte">
          <div className="footer__logo">
            <img src={logo} alt="NOVA" className="footer__logoNOVA" />
            <span className="footer__name">NOVA</span>
          </div>
          <p className="footer__text">
            Explorez les films, séries et dessins animés du moment.
          </p>
        </div>
        <div className="footer__links">
          <Link to="/">Confidentialité</Link>
          <Link to="/">Mentions Légales</Link>
          <Link to="/">Contact</Link>
        </div>
      </div>

      <p className="footer__copyright">
        © {new Date().getFullYear()} NOVA. Tous droits réservés.
      </p>
    </footer>
  );
}
