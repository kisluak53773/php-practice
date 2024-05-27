CREATE TABLE "Machines"(
    "idMachine" BIGINT NOT NULL,
    "idFactory" BIGINT NOT NULL,
    "MachineName" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Machines" ADD PRIMARY KEY("idMachine");
CREATE TABLE "WeeklyPackagingCost"(
    "idPackaging" BIGINT NOT NULL,
    "Week" VARCHAR(255) NOT NULL,
    "idProduct" BIGINT NOT NULL,
    "PackagingItem" VARCHAR(255) NOT NULL,
    "UnitMeasure" VARCHAR(255) NOT NULL,
    "TotalAmount" INTEGER NOT NULL
);
ALTER TABLE
    "WeeklyPackagingCost" ADD PRIMARY KEY("idPackaging");
CREATE TABLE "WeeklyFixCost"(
    "idFixCost" BIGINT NOT NULL,
    "idMachine" BIGINT NOT NULL,
    "Week" VARCHAR(255) NOT NULL,
    "idRegion" BIGINT NOT NULL,
    "FixCostDescription" VARCHAR(255) NOT NULL,
    "TotalAmount" BIGINT NOT NULL
);
ALTER TABLE
    "WeeklyFixCost" ADD PRIMARY KEY("idFixCost");
CREATE TABLE "DeliveryCost"(
    "idDelivery" BIGINT NOT NULL,
    "idOrder" BIGINT NOT NULL,
    "Quantity" INTEGER NOT NULL,
    "PricePerUnit" DECIMAL(8, 2) NOT NULL,
    "TotalAmount" INTEGER NOT NULL
);
ALTER TABLE
    "DeliveryCost" ADD PRIMARY KEY("idDelivery");
CREATE TABLE "FactoriesProducts"(
    "idFactoriesProducts" BIGINT NOT NULL,
    "idFactory" BIGINT NOT NULL,
    "idProduct" BIGINT NOT NULL
);
ALTER TABLE
    "FactoriesProducts" ADD PRIMARY KEY("idFactoriesProducts");
CREATE TABLE "Products"(
    "idProduct" BIGINT NOT NULL,
    "ProductName" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Products" ADD PRIMARY KEY("idProduct");
CREATE TABLE "Factories"(
    "idFactory" BIGINT NOT NULL,
    "idRegions" BIGINT NOT NULL,
    "FactoryName" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Factories" ADD PRIMARY KEY("idFactory");
CREATE TABLE "Orders"(
    "idOrder" BIGINT NOT NULL,
    "idFactory" BIGINT NOT NULL,
    "Date" DATE NOT NULL
);
ALTER TABLE
    "Orders" ADD PRIMARY KEY("idOrder");
CREATE TABLE "Regions"(
    "idRegion" BIGINT NOT NULL,
    "RegionName" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Regions" ADD PRIMARY KEY("idRegion");
CREATE TABLE "Dates"(
    "Date" DATE NOT NULL,
    "WeekDay" VARCHAR(255) NOT NULL,
    "Week" VARCHAR(255) NOT NULL,
    "Month" VARCHAR(255) NOT NULL,
    "Quarter" VARCHAR(255) NOT NULL,
    "Year" VARCHAR(255) NOT NULL
);
ALTER TABLE
    "Dates" ADD PRIMARY KEY("Date");
ALTER TABLE
    "Dates" ADD CONSTRAINT "dates_week_unique" UNIQUE("Week");
CREATE TABLE "MachineProducts"(
    "idMachineProducts" BIGINT NOT NULL,
    "idMachine" BIGINT NOT NULL,
    "idProducts" BIGINT NOT NULL
);
ALTER TABLE
    "MachineProducts" ADD PRIMARY KEY("idMachineProducts");
CREATE TABLE "OrderItem"(
    "idOrderItem" BIGINT NOT NULL,
    "idProduct" BIGINT NOT NULL,
    "idOreder" BIGINT NOT NULL,
    "Date" DATE NOT NULL,
    "Type" VARCHAR(255) NOT NULL,
    "Quantity" INTEGER NOT NULL,
    "QunitMeasure" INTEGER NOT NULL,
    "PricePerUnit" DECIMAL(8, 2) NOT NULL,
    "CostPerUnit" DECIMAL(8, 2) NOT NULL,
    "TotalAmount" INTEGER NOT NULL
);
ALTER TABLE
    "OrderItem" ADD PRIMARY KEY("idOrderItem");
ALTER TABLE
    "Orders" ADD CONSTRAINT "orders_idfactory_foreign" FOREIGN KEY("idFactory") REFERENCES "Factories"("idFactory");
ALTER TABLE
    "OrderItem" ADD CONSTRAINT "orderitem_idoreder_foreign" FOREIGN KEY("idOreder") REFERENCES "Orders"("idOrder");
ALTER TABLE
    "FactoriesProducts" ADD CONSTRAINT "factoriesproducts_idproduct_foreign" FOREIGN KEY("idProduct") REFERENCES "Products"("idProduct");
ALTER TABLE
    "FactoriesProducts" ADD CONSTRAINT "factoriesproducts_idfactory_foreign" FOREIGN KEY("idFactory") REFERENCES "Factories"("idFactory");
ALTER TABLE
    "WeeklyFixCost" ADD CONSTRAINT "weeklyfixcost_idmachine_foreign" FOREIGN KEY("idMachine") REFERENCES "Machines"("idMachine");
ALTER TABLE
    "MachineProducts" ADD CONSTRAINT "machineproducts_idproducts_foreign" FOREIGN KEY("idProducts") REFERENCES "Products"("idProduct");
ALTER TABLE
    "DeliveryCost" ADD CONSTRAINT "deliverycost_idorder_foreign" FOREIGN KEY("idOrder") REFERENCES "Orders"("idOrder");
ALTER TABLE
    "Machines" ADD CONSTRAINT "machines_idfactory_foreign" FOREIGN KEY("idFactory") REFERENCES "Factories"("idFactory");
ALTER TABLE
    "Dates" ADD CONSTRAINT "dates_week_foreign" FOREIGN KEY("Week") REFERENCES "WeeklyPackagingCost"("Week");
ALTER TABLE
    "MachineProducts" ADD CONSTRAINT "machineproducts_idmachine_foreign" FOREIGN KEY("idMachine") REFERENCES "Machines"("idMachine");
ALTER TABLE
    "Factories" ADD CONSTRAINT "factories_idregions_foreign" FOREIGN KEY("idRegions") REFERENCES "Regions"("idRegion");
ALTER TABLE
    "OrderItem" ADD CONSTRAINT "orderitem_idproduct_foreign" FOREIGN KEY("idProduct") REFERENCES "Products"("idProduct");
ALTER TABLE
    "WeeklyFixCost" ADD CONSTRAINT "weeklyfixcost_idregion_foreign" FOREIGN KEY("idRegion") REFERENCES "Regions"("idRegion");
ALTER TABLE
    "Orders" ADD CONSTRAINT "orders_date_foreign" FOREIGN KEY("Date") REFERENCES "Dates"("Date");
ALTER TABLE
    "WeeklyPackagingCost" ADD CONSTRAINT "weeklypackagingcost_idproduct_foreign" FOREIGN KEY("idProduct") REFERENCES "Products"("idProduct");
ALTER TABLE
    "Dates" ADD CONSTRAINT "dates_week_foreign" FOREIGN KEY("Week") REFERENCES "WeeklyFixCost"("Week");