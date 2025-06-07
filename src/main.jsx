import App from "./App";
import Layout from "./Layout";
import NotFound from "./pages/NotFound";
import Gallery from "./pages/gallery/Gallery";
import Product from "./pages/product/Product";
import Catalog from "./pages/product/Catalog";
import "bootstrap/dist/css/bootstrap.min.css";

import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { createBrowserRouter, RouterProvider } from "react-router-dom";

const router = createBrowserRouter([
  {
    path: "/",
    element: <Layout />,
    children: [
      { path: "/", element: <App /> },
      { path: "/gallery", element: <Gallery /> },
      { path: "/catalog", element: <Catalog /> },
      { path: "/catalog/:slug", element: <Product /> },
    ],
  },
  { path: "*", element: <NotFound /> },
]);

createRoot(document.getElementById("root")).render(
  <StrictMode>
    <RouterProvider router={router} />
  </StrictMode>
);
