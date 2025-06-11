import "./assets/css/index.css";
import { useEffect } from "react";
import LoadingScreen from "./components/Loading";
import NavbarComponent from "./components/Navbar";
import FooterComponent from "./components/Footer";
import { Outlet, useLocation } from "react-router-dom";

const Layout = () => {
  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);
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
