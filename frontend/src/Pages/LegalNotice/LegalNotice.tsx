import type { JSX } from "react";
import "./LegalNotice.scss";

interface LegalSection {
  title: string;
  texts: string[];
}

const sections: LegalSection[] = [
  {
    title: "Présentation du site",
    texts: [
      "Films, séries, dessins animés : NOVA réunit tout ce que vous aimez regarder.",
      "Nous avons créé une plateforme simple et agréable, pensée pour vous.",
      "Parcourez le catalogue et gardez vos coups de cœur dans « Ma Liste ».",
      "Reprenez vos vidéos exactement là où vous les avez arrêtées.",
      "Avec NOVA, découvrez de nouveaux titres et profitez de vos préférés, à votre rythme.",
    ],
  },
  {
    title: "Éditeur du site",
    texts: [
      "Nom du site : NOVA",
      "Éditeur : Thiziri CHEBILI",
      "Contact : page « Contact » du site",
    ],
  },
  {
    title: "Directeur de la publication",
    texts: ["La directrice de la publication est Thiziri CHEBILI."],
  },
  {
    title: "Hébergement",
    texts: [
      "Le site n'est pas encore en ligne.",
      "Les informations sur l'hébergeur seront ajoutées au moment de la mise en ligne.",
    ],
  },
  {
    title: "Propriété intellectuelle",
    texts: [
      "Le nom NOVA, le logo, le design, les textes et le code du site appartiennent à l'éditeur du site.",
      "Toute copie, même partielle, est interdite sans autorisation.",
      "Les films, les séries et leurs images appartiennent à leurs propriétaires.",
    ],
  },
  {
    title: "Données personnelles",
    texts: [
      "Pour savoir comment vos données sont utilisées, consultez la page « Confidentialité ».",
    ],
  },
  {
    title: "Cookies",
    texts: [
      "NOVA n'utilise pas de cookies publicitaires ni de traçage.",
      "Des cookies techniques peuvent être utilisés pour le bon fonctionnement du site.",
    ],
  },
  {
    title: "Responsabilité",
    texts: [
      "Nous faisons notre possible pour que les informations du site soient justes et à jour, sans pouvoir le garantir.",
    ],
  },
];

export default function LegalNotice(): JSX.Element {
  return (
    <section className="legal">
      <div className="legal__content">
        <h1 className="legal__title">Mentions légales</h1>

        {sections.map((section) => (
          <div key={section.title} className="legal__section">
            <h2 className="legal__heading">{section.title}</h2>
            {section.texts.map((text) => (
              <p key={text} className="legal__text">
                {text}
              </p>
            ))}
          </div>
        ))}
      </div>
    </section>
  );
}
