import { useState } from "react";
import type { JSX, FormEvent } from "react";
import { Link, useNavigate } from "react-router";
import { fetchAPI } from "../../utilities/fetchApi";
import "./Register.scss";

const SUCCESS_MESSAGE = "compte créé avec succès";

export default function Register(): JSX.Element {
  const [formData, setFormData] = useState({
    name: "",
    surname: "",
    email: "",
    password: "",
  });

  const [confirmPassword, setConfirmPassword] = useState("");
  const [accepted, setAccepted] = useState(false);
  const [errors, setErrors] = useState<Record<string, string>>({});

  const navigate = useNavigate();

  function validateForm(): boolean {
    const fieldErrors: Record<string, string> = {};

    if (!formData.name) {
      fieldErrors.name = "Le prénom est obligatoire";
    }

    if (!formData.surname) {
      fieldErrors.surname = "Le nom est obligatoire";
    }

    if (!formData.email) {
      fieldErrors.email = "Adresse e-mail ou identifiant requis";
    }

    if (!formData.password) {
      fieldErrors.password = "Mot de passe requis";
    } else if (formData.password.length < 8) {
      fieldErrors.password = "Le mot de passe doit faire au moins 8 caractères.";
    }

    if (confirmPassword !== formData.password) {
      fieldErrors.confirmPassword =
        "Les deux mots de passe ne sont pas identiques";
    }

    if (!accepted) {
      fieldErrors.accepted = "Vous devez accepter les conditions pour continuer.";
    }

    setErrors(fieldErrors);
    return Object.keys(fieldErrors).length === 0;
  }

  const handleSubmit = async (event: FormEvent) => {
    event.preventDefault();

    if (!validateForm()) {
      return;
    }

    const response = await fetchAPI<{ message?: string }>(
      "auth/register",
      "POST",
      formData,
    );

    if (response?.message === SUCCESS_MESSAGE) {
      navigate("/login");
    } else {
      setErrors({
        form: "Impossible de créer ce compte. Vérifiez vos informations.",
      });
    }
  };

  return (
    <section className="register">
      <div className="register__card">
        <h1 className="register__title">Créer votre profil</h1>
        <p className="register__subtitle">
          Rejoignez Nova et retrouvez vos bandes-annonces enregistrées.
        </p>

        <form className="register__form" onSubmit={handleSubmit} noValidate>
          <div className="register__row">
            <div className="register__field">
              <label className="register__label" htmlFor="name">
                Prénom
              </label>
              <input
                className="register__input"
                id="name"
                type="text"
                placeholder="Votre prénom"
                value={formData.name}
                onChange={(event) =>
                  setFormData({ ...formData, name: event.target.value })
                }
              />
              {errors.name && (
                <span className="register__error">{errors.name}</span>
              )}
            </div>

            <div className="register__field">
              <label className="register__label" htmlFor="surname">
                Nom
              </label>
              <input
                className="register__input"
                id="surname"
                type="text"
                placeholder="Votre nom"
                value={formData.surname}
                onChange={(event) =>
                  setFormData({ ...formData, surname: event.target.value })
                }
              />
              {errors.surname && (
                <span className="register__error">{errors.surname}</span>
              )}
            </div>
          </div>

          <div className="register__field">
            <label className="register__label" htmlFor="email">
              Adresse e-mail
            </label>
            <input
              className="register__input"
              id="email"
              type="email"
              placeholder="exemple@email.com"
              value={formData.email}
              onChange={(event) =>
                setFormData({ ...formData, email: event.target.value })
              }
            />
            {errors.email && (
              <span className="register__error">{errors.email}</span>
            )}
          </div>

          <div className="register__field">
            <label className="register__label" htmlFor="password">
              Mot de passe
            </label>
            <input
              className="register__input"
              id="password"
              type="password"
              placeholder="8 caractères minimum"
              value={formData.password}
              onChange={(event) =>
                setFormData({ ...formData, password: event.target.value })
              }
            />
            {errors.password && (
              <span className="register__error">{errors.password}</span>
            )}
          </div>

          <div className="register__field">
            <label className="register__label" htmlFor="confirmPassword">
              Confirmer le mot de passe
            </label>
            <input
              className="register__input"
              id="confirmPassword"
              type="password"
              value={confirmPassword}
              onChange={(event) => setConfirmPassword(event.target.value)}
            />
            {errors.confirmPassword && (
              <span className="register__error">{errors.confirmPassword}</span>
            )}
          </div>

          <div className="register__options">
            <input
              className="register__checkbox"
              id="accepted"
              type="checkbox"
              checked={accepted}
              onChange={(event) => setAccepted(event.target.checked)}
            />
            <label className="register__checkbox-label" htmlFor="accepted">
              J'accepte les conditions d'utilisation et la politique de
              confidentialité.
            </label>
          </div>
          {errors.accepted && (
            <span className="register__error">{errors.accepted}</span>
          )}

          <button className="register__button" type="submit">
            Créer mon profil
          </button>

          {errors.form && (
            <p className="register__error register__error--form">
              {errors.form}
            </p>
          )}
        </form>

        <p className="register__footer">
          Vous avez déjà un compte ?{" "}
          <Link to="/login" className="register__link">
            Se connecter
          </Link>
        </p>
      </div>
    </section>
  );
}
