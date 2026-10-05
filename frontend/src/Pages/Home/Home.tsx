import "./Home.scss";
import type { JSX } from "react";
import { useState } from "react";
import { RgpdModal } from "../../components/RgpdModal/RgpdModal";

export default function Home(): JSX.Element {
  const [modaleOuverte, setModaleOuverte] = useState(false);
  return (
    <div>
      <button onClick={() => setModaleOuverte(true)}>Tester la modale</button>
      {modaleOuverte && <RgpdModal onClose={() => setModaleOuverte(false)} />}
    </div>
  );
}
