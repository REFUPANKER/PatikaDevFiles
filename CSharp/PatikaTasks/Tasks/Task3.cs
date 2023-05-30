class Task3 : FastCommands, TaskTheme
{
#pragma warning disable
    string[,] table;
    string emptyChar = "  ";
    string circleChar = " ■";
    public void Run()
    {
        WriteLineColorized(ConsoleColor.White, "Console Triangle");
        int? circRad = null;
        while (circRad == null)
        {
            Console.Clear();
            WriteLineColorized(ConsoleColor.Yellow, "[!]Type negative number or 0 to exit");
            WriteColorized(ConsoleColor.Green, "Radius :");
            circRad = CanConvertStringToInt(ReadLine(""));
            if (circRad <= 0)
            {
                break;
            }
        }
        table = new string[(int)circRad * 2, (int)circRad * 2];
        int x = 0, y = 0;
        FillTableWith(emptyChar);
        for (int angle = 0; angle <= 360; angle++)
        {
            double radians = angle * Math.PI / 180.0;

            x = table.GetLength(0) / 2 + (int)(table.GetLength(0) / 2 * Math.Cos(radians));
            y = table.GetLength(0) / 2 + (int)(table.GetLength(0) / 2 * Math.Sin(radians));

            if (x >= 1 && x < table.GetLength(0) && y >= 1 && y < table.GetLength(0))
            {
                table[x - 1, y - 1] = circleChar;
            }
        }
        ListArray(table);
    }
    void FillTableWith(string ch)
    {
        for (int i = 0; i < table.GetLength(0); i++)
        {
            for (int j = 0; j < table.GetLength(1); j++)
            {
                table[i, j] = ch;
            }
        }
    }
    void ListArray(object[,] TABLE)
    {
        Console.Clear();
        for (int i = 0; i < TABLE.GetLength(0); i++)
        {
            for (int j = 0; j < TABLE.GetLength(1); j++)
            {
                cw(TABLE[i, j]);
            }
            cwl("");
        }
    }
}