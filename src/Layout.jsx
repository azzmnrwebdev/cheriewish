import "./assets/css/index.css";
import { useEffect } from "react";
import LoadingScreen from "./components/Loading";
import NavbarComponent from "./components/Navbar";
import FooterComponent from "./components/Footer";
import { Outlet, useLocation } from "react-router-dom";
import BackgroundImage2 from "./assets/images/background2.png";
import BackgroundImage3 from "./assets/images/background3.png";

const Layout = () => {
  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);

    const isCatalogPage = /^\/catalog\/?$/.test(pathname);
    const isProductPage = /\/catalog\/[^/]+/.test(pathname);
    const isGalleryPage = /^\/gallery\/?$/.test(pathname);

    if (isCatalogPage || isProductPage) {
      document.body.style.backgroundSize = "cover";
      document.body.style.backgroundRepeat = "no-repeat";
      document.body.style.backgroundPosition = "top center";
      document.body.style.backgroundImage = `url(${BackgroundImage2})`;
    } else if (isGalleryPage) {
      document.body.style.backgroundSize = "cover";
      document.body.style.backgroundRepeat = "no-repeat";
      document.body.style.backgroundPosition = "top center";
      document.body.style.backgroundImage = `url(${BackgroundImage3})`;
    } else {
      document.body.style.backgroundImage = "";
      document.body.style.backgroundSize = "";
      document.body.style.backgroundRepeat = "";
      document.body.style.backgroundPosition = "";
    }

    return () => {
      document.body.style.backgroundImage = "";
      document.body.style.backgroundSize = "";
      document.body.style.backgroundRepeat = "";
      document.body.style.backgroundPosition = "";
    };
  }, [pathname]);

  return (
    <>
      <LoadingScreen />
      <NavbarComponent />
      <Outlet />
      <FooterComponent />
    </>
  );
};

export default Layout;
