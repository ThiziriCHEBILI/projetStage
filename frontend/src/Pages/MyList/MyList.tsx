import type { JSX } from "react";
import { useMyList } from "../../utilities/useMyList";
import { ShowCard } from "../../components/ShowCard/ShowCard";
import { Navigate, useLocation } from "react-router";
import { useAuth } from "../../context/AuthContext";
import { loginUrl } from "../../utilities/convert";
import "./MyList.scss";

export default function MyList(): JSX.Element {
  const { myList, listLoading, listError, removeFromMyList } = useMyList();

  const { token } = useAuth();
  const location = useLocation();

  if (!token) {
    return <Navigate to={loginUrl(location.pathname)} replace />;
  }

  return (
    <section className="my-list">
      <h1 className="my-list__title">Ma Liste</h1>
      <p className="my-list__desc">
        Tous les films et séries que vous avez ajoutés à votre liste, réunis au
        même endroit.
      </p>

      {listLoading && <p className="my-list__empty">Chargement…</p>}

      {listError && <p className="my-list__empty">{listError}</p>}

      {!listLoading && !listError && myList.length === 0 && (
        <p className="my-list__empty">Votre liste est vide.</p>
      )}

      {myList.length > 0 && (
        <div className="my-list__grid">
          {myList.map((show) => (
            <div key={show.id} className="my-list__item">
              <ShowCard show={show} info="type_show" />
              <button
                type="button"
                className="my-list__remove"
                aria-label={`Retirer ${show.title} de ma liste`}
                onClick={() => removeFromMyList(show.id)}
              >
                <i className="fa-solid fa-heart" aria-hidden="true"></i>
              </button>
            </div>
          ))}
        </div>
      )}
    </section>
  );
}
