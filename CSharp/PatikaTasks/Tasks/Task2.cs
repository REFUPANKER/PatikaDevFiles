public class Task2 : FastCommands, TaskTheme
{
    public void Run()
    {
        WriteLineColorized(ConsoleColor.White, "Console Triangle");
        int? bound = null;
        while (bound == null)
        {
            Console.Clear();
            WriteLineColorized(ConsoleColor.Yellow, "[!]Type negative number or 0 to exit");
            WriteColorized(ConsoleColor.Green, "Width :");
            bound = CanConvertStringToInt(ReadLine("") + "");
            if (bound <= 0)
            {
                break;
            }
        }
        string LeftChar = "■", RightChar = "■", BottomChar = "■",FillChar=" ";
        for (int i = 0; i < bound; i++)
        {
            cwl(CreateLine(" ", bound - i) + LeftChar + CreateLine(FillChar, (i) * 2) + RightChar + CreateLine(" ", bound - i));
        }
        cwl(CreateLine(BottomChar, (bound + 1) * 2));
    }
    string CreateLine(string c, int? len)
    {
        string res = "";
        for (int i = 0; i < len; i++)
        {
            res += c;
        }
        return res;
    }
}