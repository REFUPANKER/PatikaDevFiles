class Task6 : FastCommands, TaskTheme
{
#pragma warning disable

    GeoShape[] GeoShapes = new GeoShape[]{
        new Triangle()
    };
    public void Run()
    {
        GeoShapes[0].GetCornerValues();
        GeoShapes[0].CalcArea();
        GeoShapes[0].CalcPerimeter();
        GeoShapes[0].CalcVolume();
        // object getTarget = null;
        // while (getTarget == null)
        // {
        //     TryToDo(() =>
        //     {

        //     });
        // }
    }
    class GeoShape : FastCommands
    {
        public virtual string Name { get; }
        public virtual int CornerCount { get; }
        public virtual int[] Corners { get; set; }
        public virtual void GetCornerValues()
        {
            Console.Clear();
            if (CornerCount<=0)
            {
                WriteLineColorized(ConsoleColor.Yellow, "No Corners");
                return;
            }
            Corners = new int[CornerCount];
            bool exitVerified = false;
            int value = -1;
            for (int i = 0; i < CornerCount; i++)
            {
                value = -1;
                while (value < 0)
                {
                    if (exitVerified) break;
                    if (TryToDo(() =>
                    {
                        WriteLineColorized(ConsoleColor.Cyan, $"{this.Name} : Get Corner Values");
                        WriteLineColorized(ConsoleColor.Yellow, "[!]Type negative number or 0 to exit");
                        WriteColorized(ConsoleColor.Green, $"Corner {i + 1}:");
                        value = Convert.ToInt32(ReadLine(""));
                        if (value <= 0)
                        {
                            exitVerified = true;
                        }
                        Corners[i] = value;
                        Console.Clear();
                    }) != null)
                    {
                        Console.Clear();
                        WriteLineColorized(ConsoleColor.Yellow, "[!]Value must be numeric");
                    }
                }
            }
            if (exitVerified) return;
        }
        public virtual void CalcArea() { }
        public virtual void CalcPerimeter()
        {
            int summary = 0;
            for (int i = 0; i < Corners.Length; i++)
            {
                summary += Corners[i];
            }
            WriteLineColorized(ConsoleColor.Cyan, "Perimeter :" + summary);
        }
        public virtual void CalcVolume()
        {
            WriteLineColorized(ConsoleColor.Red, "[!]Calc Volume : Method not set");
        }
    }

    class Triangle : GeoShape
    {
        public override string Name => "Triangle";
        public override int CornerCount => 3;
        public override void CalcArea()
        {
            WriteLineColorized(ConsoleColor.Cyan, $"Left :{Corners[0]} | Bottom :{Corners[1]} | Right :{Corners[2]}");
            WriteLineColorized(ConsoleColor.Green, "Area :" + ((Corners[0] * Corners[1]) / 2));
        }
        public override void CalcVolume()
        {
            WriteColorized(ConsoleColor.Cyan, "Radius :");
            int r = Convert.ToInt32(CanConvertStringToInt(ReadLine("")));
            WriteLineColorized(ConsoleColor.Green,Math.PI * Corners.Max() * r);
        }
    }

    class Circle :GeoShape
    {
        public override string Name => "Circle";
        public override int CornerCount => 0;

    }
}