export const GridItem = ({ title, value, icon }) => {
  return (
    <div className="grid-item bg-white col d-flex gap-5 align-items-center justify-content-center">
      <div className="grid-item-img">
        <img className="w-100" src={`/${icon}.png`} alt="grid" />
      </div>
      <div>
        <p className="text font-semibold">{title}</p>
        <p className="number font-semibold">{value}</p>
      </div>
    </div>
  );
};
