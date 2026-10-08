import type { JSX } from "react";
import "./RgpdModal.scss";

interface RgpdInfo {
  icon: string;
  title: string;
  text: string;
}

interface RgpdModalProps {
  onClose: () => void;
}

const infos: RgpdInfo[] = [
  {
    icon: "fa-solid fa-user",
    title: "Création du compte",
    text: "Les informations saisies (nom, e-mail, mot de passe) sont enregistrées afin de créer et gérer votre compte.",
  },
  {
    icon: "fa-solid fa-shield-halved",
    title: "Utilisation des données",
    text: "Vos données sont utilisées uniquement pour fournir et améliorer les services NOVA. Elles ne sont pas vendues ni utilisées à des fins commerciales sans votre accord.",
  },
  {
    icon: "fa-solid fa-file-lines",
    title: "Vos droits",
    text: "Vous pouvez demander l'accès, la rectification ou la suppression de vos données, ainsi que retirer votre consentement lorsque celui-ci est applicable.",
  },
  {
    icon: "fa-solid fa-clock",
    title: "Conservation",
    text: "Vos données sont conservées pendant la durée nécessaire à la gestion de votre compte et conformément aux obligations applicables.",
  },
];

export function RgpdModal({ onClose }: RgpdModalProps): JSX.Element {
  return (
    <div
      className="backdrop"
      onClick={(e) => {
        if (e.target === e.currentTarget) onClose();
      }}
    >
      <div
        className="modal"
        role="dialog"
        aria-modal="true"
        aria-label="Avant de créer votre compte"
      >
        <button
          type="button"
          className="modal__close"
          aria-label="Fermer"
          onClick={onClose}
        >
          <i className="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>

        <h2 className="modal__title">Avant de créer votre compte</h2>
        <p className="modal__subtitle">Vos données et vos droits</p>

        <ul className="modal__list">
          {infos.map((info) => (
            <li key={info.title} className="modal__item">
              <i className={info.icon} aria-hidden="true"></i>
              <div>
                <h3>{info.title}</h3>
                <p>{info.text}</p>
              </div>
            </li>
          ))}
        </ul>

        <p className="modal__consent">
          En continuant, vous reconnaissez avoir pris connaissance de ces
          informations.
        </p>

        <div className="modal__actions">
          <button type="button" className="modal__confirm">
            Continuer l'inscription
          </button>
          <button type="button" className="modal__cancel" onClick={onClose}>
            Annuler
          </button>
        </div>
      </div>
    </div>
  );
}
