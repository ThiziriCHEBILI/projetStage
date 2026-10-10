import { useState, useEffect } from "react";
import type { JSX } from "react";
import { Link } from "react-router";
import type { Show } from "../../Types";
import "./Hero.scss";

interface HeroProps {
  shows: Show[];
}

export function Hero({ shows }: HeroProps): JSX.Element {
  const [slide, setSlide] = useState(0);

  const show = shows[slide];

  const next = () => {
    setSlide(slide === shows.length - 1 ? 0 : slide + 1);
  };

  const previous = () => {
    setSlide(slide === 0 ? shows.length - 1 : slide - 1);
  };

  useEffect(() => {
    const timer = setInterval(() => {
      setSlide(slide === shows.length - 1 ? 0 : slide + 1);
    }, 6000);

    return () => clearInterval(timer);
  }, [slide, shows.length]);

  return (
    <section className="hero">
      <img src={show.image_show} alt="" className="hero__image" />

      <button
        type="button"
        className="hero__arrow hero__arrow--left"
        aria-label="Show précédent"
        onClick={previous}
      >
        <i className="fa-solid fa-chevron-left" aria-hidden="true"></i>
      </button>

      <div className="hero__content">
        <p className="hero__counter">
          {slide + 1} / {shows.length} | À LA UNE
        </p>

        {show.award && <span className="hero__badge">PRIMÉ</span>}

        <h1 className="hero__title">{show.title}</h1>

        <p className="hero__info">
          {new Date(show.release_date).getFullYear()} • {show.type_show} •{" "}
          {show.bestQuality}
        </p>

        <p className="hero__desc">{show.description}</p>

        <div className="hero__actions">
          <Link
            to="/"
            className="hero__watch"
            aria-label={`Regarder ${show.title}`}
          >
            <i className="fa-solid fa-play" aria-hidden="true"></i> Regarder
          </Link>

          <button
            type="button"
            className="hero__list"
            aria-label={`Ajouter ${show.title} à ma liste`}
          >
            <i className="fa-solid fa-plus" aria-hidden="true"></i> Ma Liste
          </button>
        </div>
      </div>

      <button
        type="button"
        className="hero__arrow hero__arrow--right"
        aria-label="Show suivant"
        onClick={next}
      >
        <i className="fa-solid fa-chevron-right" aria-hidden="true"></i>
      </button>
    </section>
  );
}
