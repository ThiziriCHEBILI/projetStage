import { useState } from "react";
import type { JSX, FormEvent } from "react";
import { useNavigate, useSearchParams } from "react-router";
import { RgpdModal } from "../../components/RgpdModal/RgpdModal";
import { fetchAPI } from "../../utilities/fetchApi";
import { useAuth } from "../../context/AuthContext";
import "./Login.scss";

export default function Login(): JSX.Element {
  const [formData, setFormData] = useState({ email: "", password: "" });
  const [showRgpd, setShowRgpd] = useState(false);
  const [remember, setRemember] = useState(false);
  const [error, setError] = useState("");
  const { setToken } = useAuth();
  const navigate = useNavigate();
  const [searchParams] = useSearchParams();
  const redirect = searchParams.get("redirect");
  const redirectedPage =
    redirect && redirect.startsWith("/") && !redirect.startsWith("//")
      ? redirect
      : "/";

  const handleSubmit = async (event: FormEvent) => {
    event.preventDefault();
    setError("");

    const response = await fetchAPI<{ token?: string; message?: string }>(
      "auth/login",
      "POST",
      formData,
    );

    if (response?.token) {
      if (remember) {
        localStorage.setItem("token", response.token);
      } else {
        sessionStorage.setItem("token", response.token);
      }
      setToken(response.token);
      navigate(redirectedPage);
    } else {
      setError("Email ou mot de passe incorrect.");
    }
  };

  return (
    <section className="login">
      <div className="login__card">
        <h1 className="login__title">Bienvenue sur Nova</h1>
        <p className="login__subtitle">
          Connectez-vous pour retrouver vos bandes-annonces enregistrées :
          films, séries et dessins animés.
        </p>

        <form className="login__form" onSubmit={handleSubmit}>
          <label className="login__label" htmlFor="email">
            Adresse e-mail
          </label>
          <input
            className="login__input"
            id="email"
            type="email"
            placeholder="exemple@email.com"
            value={formData.email}
            onChange={(event) =>
              setFormData({ ...formData, email: event.target.value })
            }
          />

          <label className="login__label" htmlFor="password">
            Mot de passe
          </label>
          <input
            className="login__input"
            id="password"
            type="password"
            value={formData.password}
            onChange={(event) =>
              setFormData({ ...formData, password: event.target.value })
            }
          />
          <div className="login__options">
            <input
              className="login__checkbox"
              id="remember"
              type="checkbox"
              checked={remember}
              onChange={(event) => setRemember(event.target.checked)}
            />
            <label className="login__checkbox-label" htmlFor="remember">
              Se souvenir de moi
            </label>
          </div>

          <button className="login__button" type="submit">
            Se connecter
          </button>
          {error && <p className="login__error">{error}</p>}
        </form>

        <p className="login__footer">
          Vous n'avez pas encore de profil ?{" "}
          <button
            className="login__link"
            type="button"
            onClick={() => setShowRgpd(true)}
          >
            Créer mon profil
          </button>
        </p>
      </div>

      {showRgpd && (
        <RgpdModal
          onClose={() => setShowRgpd(false)}
          onConfirm={() => navigate("/register")}
        />
      )}
    </section>
  );
}
